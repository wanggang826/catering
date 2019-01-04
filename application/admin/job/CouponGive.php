<?php
/**
 * Created by PhpStorm.
 * User: tiway
 * Date: 2017/12/21
 * Time: 16:29
 */

namespace app\admin\job;

use app\admin\model\Coupon;
use app\admin\model\CouponGet;
use app\admin\model\Member;
use think\queue\Job;

class CouponGive
{

    public function fire(Job $job, $data){

        foreach ($data as $val){
            switch ($val['type'])
            {
                //按消费金额从高到低
                case 1:
                    $member_ids = Member::where('total_consumption','>',0)->order('total_consumption desc')->limit($val['num'])->column('id');
                    break;
                //按消费金额从低到高
                case 2:
                    $member_ids = Member::where('total_consumption','>',0)->order('total_consumption')->limit($val['num'])->column('id');
                    break;
                //按积分从高到低
                case 3:
                    $member_ids = Member::where('integral','>',0)->order('integral desc')->limit($val['num'])->column('id');
                    break;
                //按积分从低到高
                case 4:
                    $member_ids = Member::where('integral','>',0)->order('integral')->limit($val['num'])->column('id');
                    break;
                //无限发放
                case 5:
                    $member_ids = Member::column('id');
                    break;
            }

            //领券会员数
            $counts = count($member_ids);
            if($counts > 0){
                //更新已领券数量
                Coupon::where('id',$val['coupon_id'])->update(['out_count'=>$counts]);
                $add_array = array();
                foreach ($member_ids as $key => $value){
                    $add_array[] = ['coupon_id'=> $val['coupon_id'],'member_id'=>$value,'valid_start'=>$val['valid_start'],'valid_end'=>$val['valid_end']];
                }
                $coupon_gets = new CouponGet();
                $coupon_gets->saveAll($add_array);
            }

        }
        //如果任务执行成功后 记得删除任务，不然这个任务会重复执行，直到达到最大重试次数后失败后，执行failed方法
        $job->delete();

    }

}