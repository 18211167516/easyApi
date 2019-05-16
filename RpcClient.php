<?php
$data = [
    'action' => 'call1',//行为名称
    'arg' => [
        'args1' => '111',
        'args2' => '222'
    ]
];

$raw = json_encode($data);//注意序列化类型,需要和RPC服务端约定好协议 $serializeType

$fp = stream_socket_client('tcp://192.168.99.100:9508');
fwrite($fp, pack('N', strlen($raw)) . $raw);//pack数据校验

$data = fread($fp, 65533);
//做长度头部校验
$len = unpack('N', $data);
$data = substr($data, '4');
if (strlen($data) != $len[1]) {
    echo 'data error';
} else {
    //$data = unserialize($data);
//    //这就是服务端返回的结果，
    var_dump(json_decode($data,true));//默认将返回一个response对象 通过$serializeType修改
}
fclose($fp);