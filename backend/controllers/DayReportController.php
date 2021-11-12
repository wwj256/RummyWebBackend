<?php

namespace backend\controllers;

use Yii;
use backend\models\DayReport;
use backend\models\DayReportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DayReportController implements the CRUD actions for DayReport model.
 */
class DayReportController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DayReport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DayReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DayReport model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DayReport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DayReport();
        //加载默认值
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->DayDate]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DayReport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->DayDate]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DayReport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DayReport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DayReport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DayReport::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionChangeDayReport($dayTime)
    {
        $this::UpdateDayReport($dayTime);
        return 'update complete!';
    }

    public static function UpdateDayReport($dayTime)
    {
        //新注册玩家人数
        $statisticsSql = "SELECT COUNT(*) as count  FROM lami_account.account_info WHERE IsRobot = 0 AND (DATEDIFF(RegisterDate,'$dayTime') = 0);";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryOne();
        $newPlayers = $statisticsData['count'];
        //当前日充值玩家数,统计出当日充值玩家数，当日充值玩家的充值次数，当日充值玩家的总充值次数
        $statisticsSql = "SELECT info.UserID as UserID ,COUNT(*) as count, stat.TPayCnt as PayCnt FROM lami_account.user_order_info info, lami_record.user_stat_info stat WHERE info.UserID = stat.UserID AND (info.`Status` = 1 OR info.`Status` = 3) AND (DATEDIFF(info.PayTime,'$dayTime') = 0) GROUP BY info.UserID HAVING UserID >1;";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryAll();
        $curDeposit = count($statisticsData);
        echo $curDeposit;
        //首充玩家数
        $firstDeposit = 0;
        //再充玩家数
        $secondDeposit = 0;
        foreach($statisticsData as $value){
            //当日充值玩家的总充值次数-当日充值玩家的充值次数如果小于或等于0，则是今日充值
            if( ( $value['PayCnt'] - $value['count'] ) <= 0 ){
                $firstDeposit++;
            }
            //如果玩家总充值次数大于1，则为再冲玩家，一个充冲玩家一天中冲值多次，则首冲+1，再冲也+1
            if( $value['PayCnt'] > 1 ){
                $secondDeposit++;
            }
        }
        // 'OnlinePlayers',
        // 'GamePlayers',
        // 'GameInnings',
        //今日在线人数
        $statisticsSql = "SELECT COUNT(UID) FROM lami_record.user_api_login WHERE (DATEDIFF(UpdateTime,'$dayTime') = 0) GROUP BY UID;";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryAll();
        $onlinePlayers = count($statisticsData);
        //今日玩游戏人数
        $statisticsSql = "SELECT COUNT(UID) FROM lami_record.game_record_player WHERE (DATEDIFF(BeginTime,'$dayTime') = 0) GROUP BY UID;";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryAll();
        $gamePlayers = count($statisticsData);
        //今日游戏总局数
        $statisticsSql = "SELECT COUNT(*) as count FROM lami_record.game_record WHERE (DATEDIFF(BeginTime,'$dayTime') = 0);";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryOne();
        $gameInnings = $statisticsData['count'] ? $statisticsData['count'] : 0;
        //总存款
        $statisticsSql = "SELECT SUM(Amount) as count,SUM(BindBonus) as bindBonus  FROM lami_account.user_order_info WHERE (`Status` = 1 OR `Status` = 3) AND (DATEDIFF(PayTime,'$dayTime') = 0);";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryOne();
        $totalDeposit = $statisticsData['count'] ? $statisticsData['count'] : 0;
        //总奖金
        $totalBonus = $statisticsData['bindBonus'] ? $statisticsData['bindBonus'] : 0;
        //总转账手续费
        $statisticsSql = "SELECT SUM(Amount) as count, SUM(Tax) as Tax  FROM lami_account.user_withdraw_info WHERE `Status` = 3 AND (DATEDIFF(CreateTime,'$dayTime') = 0);";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryOne();
        $totalWithdraw = $statisticsData['count'] ? $statisticsData['count'] : 0;
        $totalFee = $statisticsData['Tax'] ? $statisticsData['Tax'] : 0;
        //总税收
        $statisticsSql = "SELECT SUM(grp.PlyTax) as count, SUM(grp.BonusChg) as bonusCount FROM lami_record.game_record_player grp JOIN lami_account.account_info info WHERE grp.UID = info.UserID AND info.IsRobot = 0 AND (DATEDIFF(grp.BeginTime, '$dayTime') = 0);";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryOne();
        $totalRake = $statisticsData['count'] ? $statisticsData['count'] : 0;
        $totalUseBonus = $statisticsData['bonusCount'] ? $statisticsData['bonusCount'] : 0;

        //添加记录
        $statisticsSql = "SELECT * FROM lami_record.day_report WHERE DayDate = '$dayTime';";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryAll();

        if( count($statisticsData) > 0 ){
            $statisticsSql = "UPDATE lami_record.day_report SET NewPlayers=$newPlayers, FirstDeposit=$firstDeposit, SecondDeposit=$secondDeposit, OnlinePlayers=$onlinePlayers, GamePlayers=$gamePlayers, GameInnings=$gameInnings, TotalDeposit=$totalDeposit, TotalWithdraw=$totalWithdraw, TotalBonus=$totalBonus, TotalFee=$totalFee, TotalRake=$totalRake, UseBonus=$totalUseBonus WHERE DayDate = '$dayTime';";
        }else{
            $statisticsSql = "INSERT INTO lami_record.day_report (DayDate, NewPlayers, FirstDeposit, SecondDeposit, OnlinePlayers, GamePlayers, GameInnings, TotalDeposit, TotalWithdraw, TotalBonus, TotalFee, TotalRake, UseBonus) VALUES ('$dayTime',$newPlayers,$firstDeposit,$secondDeposit,$onlinePlayers,$gamePlayers,$gameInnings,$totalDeposit,$totalWithdraw,$totalBonus,$totalFee,$totalRake,$totalUseBonus);";
        }
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->execute();
    }
}
