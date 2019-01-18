<?php
define ('ACCESS',1); 
error_reporting(0);
//autoload 使用常量
define ( 'ADMIN_BASE', dirname ( __FILE__ ) . '/../../include' );
define ( 'ADMIN_BASE_LIB', ADMIN_BASE . '/lib/' );
define ( 'ADMIN_BASE_CLASS', ADMIN_BASE . '/class/' );

//Smarty模板使用常量
define ( 'TEMPLATE_DIR', ADMIN_BASE . '/template/' );
define ( 'TEMPLATE_COMPILED', ADMIN_BASE . '/compiled/' );
define ( 'TEMPLATE_PLUGINS', ADMIN_BASE_LIB . 'Smarty/plugins/' );
define ( 'TEMPLATE_SYSPLUGINS', ADMIN_BASE_LIB . 'Smarty/sysplugins/' );
define ( 'TEMPLATE_CONFIGS', ADMIN_BASE . '/config/' );
define ( 'TEMPLATE_CACHE', ADMIN_BASE . '/cache/' );

define ( 'VERSION' ,'1.2.2');
define ( 'REVIEW' ,'1');


define ( 'ADMIN_TITLE' ,'管理后台');
define ( 'COMPANY_NAME' ,'刘潭服装-库存管理系统');
define ('ADMIN_URL' ,'http://www.jxc.com/erp');
define('API_HOST','http://www.jxc.com/api/Public/v1/');
define('API_PUBLIC','http://www.jxc.com/api/Public/');


define ('OSA_DB_ID' ,'osadmin');
$DATABASE_LIST[OSA_DB_ID] = array ( "server"=>'localhost',
    "port"=>'3306',
    "username"=> 'root',
    "password"=>'root',
    "db_name"=>'jxc1'

);

//样例数据库设置
define ( 'SAMPLE_DB_ID' ,'sample');
$DATABASE_LIST[SAMPLE_DB_ID] = array (
	"server"=>'127.0.0.1',
	"port"=>'3306',
	"username"=> 'root',
	"password"=>'',
	"db_name"=>'osadmin' );


//COOKIE加密密钥，建议修改
define( 'OSA_ENCRYPT_KEY','vich_%erp%');

//接口
define('API_SECRECT','API%v1_ERP');


//prefix不要更改，除非修改osadmin.sql文件中的所有表名
define ( 'OSA_TABLE_PREFIX' ,'vich_');

//页面设置
define ( 'DEBUG' ,true);
define ( 'PAGE_SIZE', 15 );

$OSA_TEMPLATES=array(
	'default'=>"默认模板",
	'schoolpainting'=>'青葱校园',
	'blacktie'=>'黑色领结',
	'wintertide'=>'冰雪冬季',
);

$OSADMIN_COMMAND_FOR_LOG=array(	
							'SUCCESS'=>'成功',
							'ERROR'=>'失败',
							'ADD'=>'增加',
							'DELETE'=>'删除',
							'MODIFY'=>'修改',
							'LOGIN'=>'登录',
							'LOGOUT'=>'退出',
							'PAUSE'=>'封停',
							'PLAY'=>'解封',
				);

$OSADMIN_CLASS_FOR_LOG=array(
							'ALL' => '全部',
							'User'=>'用户',
							'UserGroup'=>'账号组',
							'Module'=>'菜单模块',
							'MenuUrl'=>'功能',
							'GroupRole'=>'权限',
							'QuickNote'=>'QuickNote',
					);
?>