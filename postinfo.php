<?php
/* 
 * SNS-API 接口测试文件
 */

$path = 'http://localhost/code/GS_MicroLearning/';
$data = array () ;
$oauth_stu = '&oauth_token=7dc4e5fe7c386d226ddcd8f011e3140c&oauth_token_secret=c80c9f3025be09e6abec30ff09097003';
$oauth_stu_3 = '&oauth_token=63a144f1d12bd6db2b0c0daa1f4335fc&oauth_token_secret=07f74c90db1e93b89c4495cf9e80a6c6';
$oauth_stu_4 = '&oauth_token=4ef395665758779ac3ac6aef6e4e1652&oauth_token_secret=bf5e5efa4ce06585a317f0bd76a6de53';
$oauth_stu_6 = '&oauth_token=681d5a4b80cfcbf8b27e86d524694349&oauth_token_secret=6fe8d5d3ab41d96d705cde784acde282';
$oauth_stu_7 = '&oauth_token=a2990ac959b27f31e9e5c44968beb878&oauth_token_secret=b7053d258e5a2c56c8c2609405b044eb';
$oauth_stu_15 = '&oauth_token=f424f32dc34c231605d7e95424689b41&oauth_token_secret=55821865e59eee6bbb414db00b1f0d7a';
$oauth_tea = '&oauth_token=c2f21a1b31e23de1472aae5b6eeaec2e&oauth_token_secret=20f6cb0e420c979bc8b0924a517004af';
$oauth_other = '&oauth_token=736ae192820281fe6be8b7ca72fabfb4&oauth_token_secret=c388b8cdc7a59da9d18d453955dfe12b';
$oauth_one = '&oauth_token=681d5a4b80cfcbf8b27e86d524694349&oauth_token_secret=6fe8d5d3ab41d96d705cde784acde282';
$test = '&oauth_token=d7dcccb46eb5b432f3d2b69b06175b74&oauth_token_secret=882023d220db47818ad3b02291782edf';



/**
 * 发送POST请求
 */
function postinfo($url, $data) {
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_POST, count ( $data ) );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
	ob_start ();
	curl_exec ( $ch );
	$result = ob_get_contents ();
	ob_end_clean ();
    echo $result;
	// var_dump($result);
    curl_close ( $ch );
    return $result;
}

/***登陆***/
// $url = $path . 'index.php?app=api&mod=Oauth&act=login&register=1';
// $data ['uid'] = 'DTZfRp24AKwyY3GRvZPLDg==';
// $data ['passwd'] = 'zr1TiHTxj8Q=';

/***注册***/
// $url = $path . 'index.php?app=api&mod=Oauth&act=register';
// $data ['email'] = 'ds9BMZPu0LoyY3GRvZPLDg==';
// $data ['passwd'] = 'zr1TiHTxj8Q=';
// $data ['uname'] = 'test2';
// $data ['sex'] = '1';
// $data ['name'] = 'test2';

/***忘记密码***/
// $url = $path . 'index.php?app=api&mod=Oauth&act=forgetPWD';
// $data ['email'] = '123@22qq.com';

/***获取个人信息***/
// $url = $path . 'index.php?app=api&mod=User&act=getUserInfo' . $test;
// $data['uid'] = '3';

/***修改个人信息***/
// $url = $path . 'index.php?app=api&mod=User&act=modifyUserInfo' . $test;
// $data ['uname'] = '佐天泪子';

/***获取班级列表***/
// $url = $path . 'index.php?app=api&mod=Group&act=getGroups' . $test;
// $data ['subject_code'] = 5;

/***搜索班级列表***/
// 主要操作gs_group进行查询
// $url = $path . 'index.php?app=api&mod=Group&act=searchGroup' . $oauth_stu;
// $data ['group_name'] = '都市';      //班级名称 
// $data ['subject_code'] = 5;     //科目ID

/**获取班级的作业列表****/
// $url = $path . 'index.php?app=api&mod=Group&act=getWorkList' . $oauth_stu_4;
// $data ['gid'] = '2';     //班级ID

/***获取班级作业试题列表***/
// 主要操作 gs_group_work 进行查询
// $url = $path . 'index.php?app=api&mod=Group&act=getGroupWorkTitleList' . $oauth_stu_4;
// $data ['class_work_id'] = '1';        

/***获取解析附件列表（包括视频和附件）***/
// $url = $path . '' . $oauth_stu;

/***获取班级作业详情***/
// $url = $path . 'index.php?app=api&mod=Group&act=getWorkDetail' . $oauth_stu_7;
// $data ['gid'] = '2';
// $data ['class_work_id'] = '7';

/***获取班级作业学生答案情况***/
// 操作 gs_group_post 
// $url = $path . 'index.php?app=api&mod=Work&act=getWorkDoneInfo' . $test;
// $data ['gid'] = '1';
// $data ['class_work_id'] = '7';
// $data ['uid'] = '10';

/***布置作业***/
// 数据会插入 gs_group_work 这里的work_id 指的是教师作业 数据库为：gs_title_work
// $url = $path . 'index.php?app=api&mod=Group&act=publishWork' . $oauth_stu_7;
// $data ['title'] = '境界的彼方';
// $data ['description'] = '不愉快death~!';
// $data ['gids'] = '2';
// $data ['titleids'] = '1439,1440,1438';
// $data ['endtime'] = time();
// $data ['work_id'] = '5';
// $data ['label'] = '妖梦';
// $data ['credit'] = '20';

/***公布答案***/
// 修改 gs_group_topic 中对应数据的  is_answer 0/1 的值
// $url = $path . 'index.php?app=api&mod=Work&act=publishAnswer' . $oauth_tea;
// $data ['class_work_id'] = '109';
// $data ['gid'] = '64';

/***公布解析答案（包含附件解析和视频解析）***/
// $url = $path . 'index.php?app=api&mod=Work&act=publishExplainFile' . $oauth_tea;
// $data ['class_work_id'] = '109';
// $data ['gid'] = '64';
// $data ['video'] = '1';
// $data ['attach'] = '1';

/***申请加入班级***/
// $url = $path . 'index.php?app=api&mod=Group&act=joinGroup' . $oauth_stu;
// $data ['uid'] = '33';
// $data ['gid'] = '1';
// $data ['invitecode'] = '123456';

/***创建班级（未完成）***/
// $url = $path . 'index.php?app=api&mod=Group&act=createGroup' . $oauth_tea;
// $data ['name'] = 'API测试';
// $data ['cid1'] = '5';
// $data ['cid0'] = '1';
// $data ['intro'] = 'API测试';
// $data ['logo'] = ''; //文件传递
// $data ['invitecode'] = '123456';

/***退出班级***/
// $url = $path . 'index.php?app=api&mod=Group&act=exitGroup' . $oauth_stu;
// $data ['gid'] = '65';

/***解散班级***/
// $url = $path . 'index.php?app=api&mod=Group&act=dismissGroup' . $oauth_stu_6;
// $data ['gid'] = '3';

/***获取班级信息***/
// $url = $path . 'index.php?app=api&mod=Group&act=getGroupInfo' . $oauth_stu;
// $data ['gid'] = '64';

/***更新班级信息***/
// $url = $path . 'index.php?app=api&mod=Group&act=updateGroupInfo' . $oauth_tea;
// $data ['gid'] = '64';
// $data ['intro'] = '当妈~你的幻想就由我来打破！';

/***获取班级成员列表***/
// $url = $path . 'index.php?app=api&mod=Group&act=getGroupMembers' . $test;
// $data ['gid'] = '1';

/***成员权限管理***/
// $url = $path . 'index.php?app=api&mod=Group&act=updateMemberRole' . $oauth_tea;

/***删除班级成员***/
// $url = $path . 'index.php?app=api&mod=Group&act=delMember' . $oauth_tea;
// $data ['gid'] = '';
// $data ['del_uid'] = '';


// $url = $path . 'index.php?app=api&mod=Title&act=checkTitleAsw' . $oauth_stu;
// $data ['gid'] = '23';
// $data ['group_work_id'] = '111';
// $data ['IMEI'] = '91828d9909f74905';

// $url = $path . 'index.php?app=api&mod=Title&act=dropTitleAsw' . $oauth_other;
// $data ['gid'] = '23';
// $data ['group_work_id'] = '111';
// $data ['IMEI'] = '91828d9909f74911';

//$url = $path . 'index.php?app=api&mod=Tiku&act=modifyUserCollect' . $oauth_tea;
//$data ['category_id'] = '157';
//$data ['title'] = 'LEE';
//$data ['type'] = '1';
//$data ['remark'] = 'LEVEL5';

// $url = $path . 'index.php?app=api&mod=Tiku&act=addUserCollect' . $oauth_tea;
// $data ['pid'] = '01020000';
// $data ['title'] = 'LEE3';
// $data ['remark'] = 'LEVEL5';
// $data ['type'] = '1';

/***获取领域条件***/
// $url = $path . 'index.php?app=api&mod=Tiku&act=getDomainCondition' . $oauth_stu;
// $data ['pid'] = '1';

/***获取知识点的1级查询条件***/
// $url = $path . 'index.php?app=api&mod=Tiku&act=getKnowledge_L1' . $oauth_other;
// $data ['pid'] = '5';

/***获取知识点的2-4级查询条件***/
// $url = $path . 'index.php?app=api&mod=Tiku&act=getKnowledge_L2_L4' . $oauth_stu;
// $data ['pid'] = '1';

/***获取试题(理科)***/
// $url = $path . 'index.php?app=api&mod=Tiku&act=searchTitle_Science' . $test;
// $data ['grade_id'] = '166';
// $data ['chapter_id'] = '321';
// $data ['unit_id'] = '368';
// $data ['titleType'] = '1';
// $data ['num'] = '10';
// $data ['screenWidth'] = '720';

/***获取试题(文科)***/
// $url = $path . 'index.php?app=api&mod=Tiku&act=searchTitle_Arts' . $test;
// $data ['ebook1_id'] = '1';
// $data ['ebook2_id'] = '2';
// $data ['ebook3_id'] = '3';
// $data ['ebook4_id'] = '4';
// $data ['titleType'] = '4';

/***获取1教材信息***/
// $url = $path . 'index.php?app=api&mod=Tiku&act=getEbook_L1' . $oauth_stu;
// $data ['pid'] = '3';

/***获取2-4教材信息***/
// $url = $path . 'index.php?app=api&mod=Tiku&act=getEbook' . $oauth_stu;
// $data ['pid'] = '0';

/***获取课文信息***/
// $url = $path . 'index.php?app=api&mod=Tiku&act=getLesson' . $oauth_stu;
// $data ['ebook_id'] = '1';

/***获取题目详情***/
// $url = $path . 'index.php?app=api&mod=Tiku&act=getTitleDetails' . $oauth_one;
// $data ['title_id'] = '1';

/***获取1级题型***/
// $url = $path . 'index.php?app=api&mod=Tiku&act=getTitleTypeCond' . $test;
// $data ['pid'] = '5';

/***获取2级题型***/
// $url = $path . 'index.php?app=api&mod=Tiku&act=getTitleTypeCond2' . $oauth_stu;
// $data ['pid'] = '4';

/***随机取题(理科)***/
// $url = $path . 'index.php?app=api&mod=Tiku&act=getRandomTitles_Science' . $test;
// $data ['grade_id'] = '166';
// $data ['chapter_id'] = '321';
// $data ['unit_id'] = '368';
// $data ['titleType'] = '1';
// $data ['num'] = '10';
// $data ['screenWidth'] = '720';
// $data ['category_id'] = '15';

/***随机取题(文科)***/
// $url = $path . 'index.php?app=api&mod=Tiku&act=getRandomTitles_Arts' . $test;
// $data ['ebook1_id'] = '1';
// $data ['num'] = '15';
// $data ['category_id'] = '15';
// $data ['littleTitleType'] = '5';

/***获取作业试题列表***/
// $url = $path . 'index.php?app=api&mod=Title&act=getWorkTitleList' . $oauth_one;
// $data ['work_id'] = '4';
// $data ['screenWidth'] = '540';

/***获取收藏夹内试题***/
// $url = $path . 'index.php?app=api&mod=Tiku&act=getCollectedTitles' . $oauth_stu_3;
// $data ['category_id'] = '3';
// $data ['screenWidth'] = '1080';

/***获取某个科目下我创建的班级列表***/
// $url = $path . 'index.php?app=api&mod=Group&act=getMyGroup' . $oauth_one;
// $data ['subject_code'] = '5';

// $url = $path . 'index.php?app=api&mod=Title&act=submitWork' . $test;
// $data ['gid'] = '2'; // 班级ID
// $data ['class_work_id'] = '1'; // 作业ID

// $url = $path . 'index.php?app=api&mod=Title&act=getWorkList' . $test;
// $data ['category_id'] = '2';    

// $url = $path . 'index.php?app=api&mod=Group&act=getWorkList' . $test;
// $data ['gid'] = '1';     //班级ID

// $url = $path . 'index.php?app=api&mod=Group&act=buyGroupWork' . $oauth_stu_7;
// $data ['class_work_id'] = '3';    

// $url = $path . 'index.php?app=api&mod=Message&act=getMessageDetails' . $oauth_one;
// $data['list_id'] = '22';

// $url = $path . 'index.php?app=api&mod=Group&act=handleRequestForJoin' . $oauth_one; 
// $data['from_uid'] = '70';
// $data['gid'] = '1';
// $data['isagree'] = '0';

// $url = $path . 'index.php?app=api&mod=Title&act=remarkWork' . $test;
// $data['gid'] = '17'; // 班级ID
// $data['class_work_id'] = '9'; // 作业ID
// $data['to_uid'] = '73';
// $data['content'] = '999999';

// $url = $path . 'index.php?app=api&mod=User&act=getUserVideo' . $oauth_stu_3; 
// $data['start'] = '14';
// $data['domain_id'] = '5';


/*私信列表*/
// $url = $path . 'index.php?app=api&mod=Message&act=getMessageList_API' . $oauth_stu_6;

// $url = $path . 'index.php?app=api&mod=Tiku&act=getDomainCondition' . $test;
// $data['pid']='0';




// 发送请求
$res = postinfo ( $url, $data );
$obj = json_decode($res,true);
header("Content-type:text/html;charset=utf-8");
var_dump($obj);

