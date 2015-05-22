<?php

/**
 * 损益单回传信息
 * @author auto create
 */
class WlbWmsInventoryCount
{
	
	/** 
	 * 商品信息列表
	 **/
	public $itemList;
	
	/** 
	 * 订单类型：701 盘点出库（盘亏） 702 盘点入库（盘盈）
	 **/
	public $orderType;
	
	/** 
	 * WMS损益单据唯一编号
	 **/
	public $outBizCode;
	
	/** 
	 * 货主ID
	 **/
	public $ownerUserId;
	
	/** 
	 * 备注
	 **/
	public $remark;
	
	/** 
	 * 仓库编码
	 **/
	public $storeCode;	
}
?>