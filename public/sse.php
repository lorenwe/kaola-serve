<?php

date_default_timezone_set("Asia/Shanghai");
header("X-Accel-Buffering: no");
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");
header("Access-Control-Allow-Origin: *");

while (true) {
    $curDate = date(DATE_ISO8601);
    echo "event: ping\n",
        'data: {"time": "' . $curDate . '"}', "\n\n";

    $data = [
        "title" => "花西子就被传谣为日本品牌向警方报案",
        "content" =>  "<p><span style=\"color: rgb(51, 51, 51);\">近日，随着某知名主播不当言论链式风波甚嚣尘上，“花西子是日本品牌”等截图在网络上流传。对此，花西子表示：花西子品牌名中的“花”，取自于品牌理念中的“以花养妆”；“西子”则指的是西湖，灵感来自苏东坡的名句“欲把西湖比西子，淡妆浓抹总相宜”。</span></p><p><span style=\"color: rgb(51, 51, 51);\">同时，花西子接受媒体采访中对探访视频表示：2019年曾与日本某研究所有过短期产研和生产合作，2020年已停止合作。随着国内美妆研发及产业链的综合实力的持续上升，目前花西子的研发中心及生产工厂100%都在国内。</span></p><p><span style=\"color: rgb(51, 51, 51);\">据花西子产品外包装上显示，委托方为中国杭州，产地为中国上海，未有任何日本相关工厂信息。</span></p><p><span style=\"color: rgb(51, 51, 51);\">据了解，此前花西子还曾获得由新华社颁发的“中国品牌全球传播力”top10。综上网传“花西子产地为日本”“花西子是日本品牌”皆为谣言，并就此向警方报案。</span></p>",
        "type" =>  "1",
        "name" =>  "lorenwe",
        "avatar_url" =>  "http://127.0.0.1:8000/uploads/avatar/20240513090542-3984.png",
    ];
    $data_str = json_encode($data);
    echo 'data: '. $data_str . "\n\n";

    // flush the output buffer and send echoed messages to the browser
    while (ob_get_level() > 0) {
        ob_end_flush();
    }
    flush();

    // 如果客户端中止连接，则中断循环（关闭页面）
    if (connection_aborted()) break;

    sleep(1); // 每秒循环一次
}
