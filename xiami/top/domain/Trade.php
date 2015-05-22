<?php

/**
 * 交易详细信息
 * @author auto create
 */
class Trade
{
	
	/** 
	 * 卖家手工调整金额，精确到2位小数，单位：元。如：200.07，表示：200元7分。来源于订单价格修改，如果有多笔子订单的时候，这个为0，单笔的话则跟[order].adjust_fee一样
	 **/
	public $adjustFee;
	
	/** 
	 * 淘宝下单成功了,但由于某种错误支付宝订单没有创建时返回的信息。taobao.trade.add接口专用
	 **/
	public $alipayWarnMsg;
	
	/** 
	 * 买家货到付款服务费。精确到2位小数;单位:元。如:12.07，表示:12元7分
	 **/
	public $buyerCodFee;
	
	/** 
	 * 买家备注旗帜（与淘宝网上订单的买家备注旗帜对应，只有买家才能查看该字段）红、黄、绿、蓝、紫 分别对应 1、2、3、4、5
	 **/
	public $buyerFlag;
	
	/** 
	 * 买家备注（与淘宝网上订单的买家备注对应，只有买家才能查看该字段）
	 **/
	public $buyerMemo;
	
	/** 
	 * 买家留言
	 **/
	public $buyerMessage;
	
	/** 
	 * 买家昵称
	 **/
	public $buyerNick;
	
	/** 
	 * 买家是否已评价。可选值:true(已评价),false(未评价)。如买家只评价未打分，此字段仍返回false
	 **/
	public $buyerRate;
	
	/** 
	 * 卖家发货时间。格式:yyyy-MM-dd HH:mm:ss
	 **/
	public $consignTime;
	
	/** 
	 * 交易创建时间。格式:yyyy-MM-dd HH:mm:ss
	 **/
	public $created;
	
	/** 
	 * 使用信用卡支付金额数
	 **/
	public $creditCardFee;
	
	/** 
	 * 建议使用trade.promotion_details查询系统优惠系统优惠金额（如打折，VIP，满就送等），精确到2位小数，单位：元。如：200.07，表示：200元7分
	 **/
	public $discountFee;
	
	/** 
	 * 交易结束时间。交易成功时间(更新交易状态为成功的同时更新)/确认收货时间或者交易关闭时间 。格式:yyyy-MM-dd HH:mm:ss
	 **/
	public $endTime;
	
	/** 
	 * 判断订单是否有买家留言，有买家留言返回true，否则返回false
	 **/
	public $hasBuyerMessage;
	
	/** 
	 * 是否包含邮费。与available_confirm_fee同时使用。可选值:true(包含),false(不包含)
	 **/
	public $hasPostFee;
	
	/** 
	 * 交易修改时间(用户对订单的任何修改都会更新此字段)。格式:yyyy-MM-dd HH:mm:ss
	 **/
	public $modified;
	
	/** 
	 * 商品购买数量。取值范围：大于零的整数,对于一个trade对应多个order的时候（一笔主订单，对应多笔子订单），num=0，num是一个跟商品关联的属性，一笔订单对应多比子订单的时候，主订单上的num无意义。
	 **/
	public $num;
	
	/** 
	 * 商品数字编号
	 **/
	public $numIid;
	
	/** 
	 * 订单列表
	 **/
	public $orders;
	
	/** 
	 * 付款时间。格式:yyyy-MM-dd HH:mm:ss。订单的付款时间即为物流订单的创建时间。
	 **/
	public $payTime;
	
	/** 
	 * 实付金额。精确到2位小数;单位:元。如:200.07，表示:200元7分
	 **/
	public $payment;
	
	/** 
	 * 商品图片绝对途径
	 **/
	public $picPath;
	
	/** 
	 * 邮费。精确到2位小数;单位:元。如:200.07，表示:200元7分
	 **/
	public $postFee;
	
	/** 
	 * 商品价格。精确到2位小数；单位：元。如：200.07，表示：200元7分
	 **/
	public $price;
	
	/** 
	 * 收货人的详细地址
	 **/
	public $receiverAddress;
	
	/** 
	 * 收货人的所在城市<br>注：因为国家对于城市和地区的划分的有：省直辖市和省直辖县级行政区（区级别的）划分的，淘宝这边根据这个差异保存在不同字段里面比如：广东广州：广州属于一个直辖市是放在的receiver_city的字段里面；而河南济源：济源属于省直辖县级行政区划分，是区级别的，放在了receiver_district里面<br>建议：程序依赖于城市字段做物流等判断的操作，最好加一个判断逻辑：如果返回值里面只有receiver_district参数，该参数作为城市
	 **/
	public $receiverCity;
	
	/** 
	 * 收货人国籍
	 **/
	public $receiverCountry;
	
	/** 
	 * 收货人的所在地区<br>注：因为国家对于城市和地区的划分的有：省直辖市和省直辖县级行政区（区级别的）划分的，淘宝这边根据这个差异保存在不同字段里面比如：广东广州：广州属于一个直辖市是放在的receiver_city的字段里面；而河南济源：济源属于省直辖县级行政区划分，是区级别的，放在了receiver_district里面<br>建议：程序依赖于城市字段做物流等判断的操作，最好加一个判断逻辑：如果返回值里面只有receiver_district参数，该参数作为城市
	 **/
	public $receiverDistrict;
	
	/** 
	 * 收货人的手机号码
	 **/
	public $receiverMobile;
	
	/** 
	 * 收货人的姓名
	 **/
	public $receiverName;
	
	/** 
	 * 收货人的电话号码
	 **/
	public $receiverPhone;
	
	/** 
	 * 收货人的所在省份
	 **/
	public $receiverState;
	
	/** 
	 * 收货人街道地址
	 **/
	public $receiverTown;
	
	/** 
	 * 收货人的邮编
	 **/
	public $receiverZip;
	
	/** 
	 * 卖家备注旗帜（与淘宝网上订单的卖家备注旗帜对应，只有卖家才能查看该字段）红、黄、绿、蓝、紫 分别对应 1、2、3、4、5
	 **/
	public $sellerFlag;
	
	/** 
	 * 卖家备注（与淘宝网上订单的卖家备注对应，只有卖家才能查看该字段）
	 **/
	public $sellerMemo;
	
	/** 
	 * 卖家昵称
	 **/
	public $sellerNick;
	
	/** 
	 * 卖家是否已评价。可选值:true(已评价),false(未评价)
	 **/
	public $sellerRate;
	
	/** 
	 * 创建交易时的物流方式（交易完成前，物流方式有可能改变，但系统里的这个字段一直不变）。可选值：free(卖家包邮),post(平邮),express(快递),ems(EMS),virtual(虚拟发货)，25(次日必达)，26(预约配送)。
	 **/
	public $shippingType;
	
	/** 
	 * 交易状态。可选值:    * TRADE_NO_CREATE_PAY(没有创建支付宝交易)    * WAIT_BUYER_PAY(等待买家付款)    * SELLER_CONSIGNED_PART(卖家部分发货)    * WAIT_SELLER_SEND_GOODS(等待卖家发货,即:买家已付款)    * WAIT_BUYER_CONFIRM_GOODS(等待买家确认收货,即:卖家已发货)    * TRADE_BUYER_SIGNED(买家已签收,货到付款专用)    * TRADE_FINISHED(交易成功)    * TRADE_CLOSED(付款以后用户退款成功，交易自动关闭)    * TRADE_CLOSED_BY_TAOBAO(付款以前，卖家或买家主动关闭交易)    * PAY_PENDING(国际信用卡支付付款确认中)    * WAIT_PRE_AUTH_CONFIRM(0元购合约中)
	 **/
	public $status;
	
	/** 
	 * 交易编号 (父订单的交易编号)
	 **/
	public $tid;
	
	/** 
	 * 交易标题，以店铺名作为此标题的值。注:taobao.trades.get接口返回的Trade中的title是商品名称
	 **/
	public $title;
	
	/** 
	 * 商品金额（商品价格乘以数量的总金额）。精确到2位小数;单位:元。如:200.07，表示:200元7分
	 **/
	public $totalFee;
	
	/** 
	 * 交易内部来源。WAP(手机);HITAO(嗨淘);TOP(TOP平台);TAOBAO(普通淘宝);JHS(聚划算)一笔订单可能同时有以上多个标记，则以逗号分隔
	 **/
	public $tradeFrom;
	
	/** 
	 * 交易类型列表，同时查询多种交易类型可用逗号分隔。默认同时查询guarantee_trade, auto_delivery, ec, cod的4种交易类型的数据 可选值 fixed(一口价) auction(拍卖) guarantee_trade(一口价、拍卖) auto_delivery(自动发货) independent_simple_trade(旺店入门版交易) independent_shop_trade(旺店标准版交易) ec(直冲) cod(货到付款) fenxiao(分销) game_equipment(游戏装备) shopex_trade(ShopEX交易) netcn_trade(万网交易) external_trade(统一外部交易)o2o_offlinetrade（O2O交易）step (万人团)nopaid(无付款订单)pre_auth_type(预授权0元购机交易)
	 **/
	public $type;	
}
?>