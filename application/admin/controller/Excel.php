<?php
namespace app\admin\controller;
use think\Controller;
class Excel extends Ro{

    // 有效订单
    public function Excel_order(){

        $xlsName  = "有效订单";
        $xlsCell  = array(
            array('or_name','产品名'),
            array('or_style','款式'),
            array('or_moeny','金额'),
            array('or_number','数量'),
            array('or_user','用户'),
            array('or_tel','电话'),
            array('or_addr','地址'),
            array('or_goods','订单状态'),
            array('or_tive','是否有效'),
            array('or_ip','ip'),
            array('or_ip_adds','ip地区'),
            array('or_order','订单号'),
            array('create_time','添加时间'),
        );
        $where = [] ;
        $sex = input('sex');
        $key = input('key');
        $numbers = input('numbers');  //垃圾单

        if($key){
            $where['or_goods'] = ['eq',$key];
        }

        if ($numbers) {
            $where['or_order'] = ['like',"%$numbers%"];
        }

        if ($sex != 500) {
            if($sex){
                $where['or_tive'] = ['eq',$sex];
            }else{
                $where['or_tive'] = ['eq',1];  //有效订单
            }
        }
        $kaishi = strtotime(input('kaishi')); //开始时间
        $jieshi = input('jieshi'); //结束时间
        if($kaishi && $jieshi){
            $jieshi = strtotime($jieshi.'23:59:59');
            $where['create_time'] = ['between',[$kaishi,$jieshi]];
        }else if($kaishi){
            $where['create_time'] = ['egt',$kaishi];
        }else if($jieshi){
            $jieshi = strtotime($jieshi.'23:59:59');
            $where['create_time'] = ['elt',$jieshi];
        }
        $xlsData  = \think\Db::name('Order')->where($where)->order('or_id desc')->select();
        foreach($xlsData as $k=>$v){
            $xlsData[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
            if($v['or_goods']==4){
                $xlsData[$k]['or_goods'] = '未处理';
            }else if($v['or_goods']==1){
                $xlsData[$k]['or_goods'] = '发货中';
            }else if($v['or_goods']==3){
                $xlsData[$k]['or_goods'] = '确定退货';
            }else if($v['or_goods']==2){
                $xlsData[$k]['or_goods'] = '确定签收';
            }else if($v['or_goods']==5){
                $xlsData[$k]['or_goods'] = '再联系';
            }else if($v['or_goods']==6){
                $xlsData[$k]['or_goods'] = '未发货';
            }else if($v['or_goods']==7){
                $xlsData[$k]['or_goods'] = '待审核';
            }else if($v['or_goods']==8){
                $xlsData[$k]['or_goods'] = '垃圾';
            }else if($v['or_goods']==9){
                $xlsData[$k]['or_goods'] = '拒收';
            }else if($v['or_goods']==10){
                $xlsData[$k]['or_goods'] = '已完成';
            }else if($v['or_goods']==11){
                $xlsData[$k]['or_goods'] = '售后状态';
            }

            if($v['or_tive']==1){
                $xlsData[$k]['or_tive'] = '有效';
            }else{
                $xlsData[$k]['or_tive'] = '无效';
            }
        }

        $this->exportExcel($xlsName,$xlsCell,$xlsData);

    }

    public function exportExcel($expTitle,$expCellName,$expTableData){
        {
            $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
            $fileName = $expTitle.date('_Y-m-d H:i:s');//or $xlsTitle 文件名称可根据自己情况设定
            $cellNum = count($expCellName);
            $dataNum = count($expTableData);
    
            vendor("PHPExcel.PHPExcel");
            import('PHPExcel.PHPExcel', EXTEND_PATH,'.php');
            $objPHPExcel = new \PHPExcel();
            $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
    
            $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
            for($i=0;$i<$cellNum;$i++){
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
                //$objPHPExcel->getActiveSheet()->getColumnDimension($cellName[$i])->setAutoSize(true); //自适应
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(50); //手动设置
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20); //手动设置
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20); //手动设置
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20); //手动设置
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20); //手动设置
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20); //手动设置
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50); //手动设置
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20); //手动设置
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20); //手动设置
                $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20); //手动设置
                $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30); //手动设置
                $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(50); //手动设置
                $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20); //手动设置
             }
            // Miscellaneous glyphs, UTF-8
            for($i=0;$i<$dataNum;$i++){
                for($j=0;$j<$cellNum;$j++){
                    $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
                }
            }
    
                // Redirect output to a client's web browser (Excel5) 
                ob_end_clean();//清除缓冲区,避免乱码
                header('pragma:public');
                header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
                header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
                $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('php://output');
                exit;
            }
        }

}


?>