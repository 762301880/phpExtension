<?php


namespace app\common\service;


class PaginateService
{
    /**
     * 页码默认长度
     */
    const PAGE_DEFAULT = 1;
    /**
     * 每页现实条数默认
     */
    const LIMIT_DEFAULT = 10;

    /**
     * 添加分页返回封装数据(小程序)
     * @param $data
     * @return mixed
     */
    public static function appendResponseData(&$data)
    {
        $data = $data->toArray();
        $data['this_page'] = $data['current_page'];
        $data['total_page'] = ceil($data['total'] / $data['per_page']);
        return $data;
    }

    /**
     * 修改对应后台返回(后台)
     * @param $data
     * @return mixed
     */
    public static function appendBackstageResponseData(&$data, $extensionData = [])
    {

        $data = $data->toArray();
        $data['count'] = $data['total'];
        $data['list'] = $data['data'];
        /**
         * 如果有扩展数据的情况下添加扩展数据
         * 传递示例
         * $extensionData= ['refund_status_list' => OrderPaymentModel::getRefundStatusList()];
         */
        if (!empty($extensionData)) {
            foreach ($extensionData as $key => $element) {
                $data[$key] = $element;
            }
        }
        unset($data['data']);#删除原有的数据
        return $data;
    }
}