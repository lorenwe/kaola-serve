<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function orderBytest(Request $request)
    {
        $order_by     = $request -> input("order_by", '');         // 排序字段
        $order_arr    = json_decode($order_by, true);
        dd($order_by, $order_arr);
        // 验证排序参数是否符合规范
        if (is_array($order_by)) {
            $order_field = $order_by[0];
            $field_array = array('price', 'area', 'unit_price', 'create_at', 'update_at');
            if (!in_array($order_field, $field_array)) {
                $order_by = null;
            }
            $sort_field = $order_by[1];
            $desc_array = array('DESC', 'ASC');
            if (!in_array($sort_field, $desc_array)) {
                $order_by = null;
            }
        } else {
            $order_by = null;
        }
    }

    public function priceGenerate(Request $request)
    {
        $data     = urldecode($request -> input("data"));    // 数据
        $is_new   = $request -> input("is_new", '2'); // 是否是新房
        //dd($data);
        if(empty($data)) {
            return ['errno' => 3, 'errmsg' => '数据有误'];
        }
        try {
            if ($is_new == '1') {
                $generate_data = $this->priceNew($data);
            } else {
                $generate_data = $this->priceEs($data);
            }
        } catch(\Throwable $e) {
            return ['errno' => 3, 'errmsg' => '生成出错，请手动录入'];
        }
        return ['errno' => 0, 'errmsg' => '成功', 'data' => $generate_data];
    }

    protected function priceNew($data)
    {
        $generate_data = [];
        $res = explode('/m', $data);
        //dd($res);
        foreach ($res as $item) {
            if ($item == '' || $item == '2' || $item == '²') {
                continue;
            }
            $res2 = explode('签约日期:', $item);
            $area_data = $res2[0];
            $time_price = $res2[1];
            $res3 = explode("\n", $time_price);
            $time_str = str_replace([' '], '', $res3[0]); // 去除空格
            $time = strval(strToUinxTime($time_str));  // 成交时间
            $price = floatval(str_replace(['元',' '], "", $res3[1]));  // 成交单价
            $res4 = explode("-", $area_data);
            $house = $res4[0];   // 户型
            $area = floatval(str_replace(['m2'|'m'|'m²'], "", $res4[1]));  // 面积
            $total = $res4[2];

            $res5 = explode("\n", $total);
            $layer_str = str_replace(['层'], "", $res5[0]);             // 当前楼层和总楼层
            $total_price = floatval(str_replace(['万',' '], "", $res5[1]));       // 成交总价
            $res6 = explode("/", $layer_str);
            $cur_layer  = $res6[0];       // 当前楼层
            $layer      = $res6[1];       // 总楼层
            // $total_price2 = $price * $area; // 计算总价
            array_push($generate_data, [
                'time' => $time_str,
                'sign_at' => $time,
                'company' => "新房",
                'unit_price' => $price,
                'area' => $area,
                'cur_layer' => $cur_layer,
                'layer' => $layer,
                'price' => $total_price,
            ]);
            dd($generate_data);
            // dd($time, $price, $house, $area, $cur_layer, $layer, $total_price);
        }
        return $generate_data;
    }

    protected function priceEs($data)
    {
        $generate_data = [];
        $res = explode('/m', $data);
        // dd($res);
        foreach ($res as $item) {
            if ($item == '' || $item == '2' || $item == '²') {
                continue;
            }
            $res2 = explode('签约中介:', $item);
            $area_data = $res2[0];
            $time_price = $res2[1];
            $res7 = explode("签约日期:", $time_price);
            $company = str_replace(["\t","\n"], "", $res7[0]);
            $time_price = $res7[1];
            $res3 = explode("\n", $time_price);
            $time_str = $res3[0];
            $time = strval(str_to_uinxtime($res3[0]));  // 成交时间
            $price = floatval(str_replace(['元'], "", $res3[1]));  // 成交单价
            $res4 = explode("-", $area_data);
            $house = $res4[0];   // 户型
            $area = floatval(str_replace(['m2'|'m'|'m²'], "", $res4[1]));  // 面积
            $total = $res4[2];
            $res5 = explode("\n", $total);
            $layer_str = str_replace(['层'], "", $res5[0]);             // 当前楼层和总楼层
            $total_price = floatval(str_replace(['万'], "", $res5[1]));       // 成交总价
            $res6 = explode("/", $layer_str);
            $cur_layer  = $res6[0];       // 当前楼层
            $layer      = $res6[1];       // 总楼层
            // $total_price2 = $price * $area; // 计算总价
            array_push($generate_data, [
                'time' => $time_str,
                'sign_at' => $time,
                'company' => $company,
                'unit_price' => $price,
                'area' => $area,
                'cur_layer' => $cur_layer,
                'layer' => $layer,
                'price' => $total_price,
            ]);
            // dd($time, $price, $house, $area, $cur_layer, $layer, $total_price);
        }
        return $generate_data;
    }

    public function sendMessage(): JsonResponse {
        $message = [
            'user_id' => '111',
            'text' => 'text',
            'message' => 'message',
            'time' => date("Y-m-d H:i")
        ];
        SendMessage::dispatch($message);

        return response()->json([
            'success' => true,
            'message' => "Message created and job dispatched.",
        ]);
    }
}
