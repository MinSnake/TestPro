function g(e) {
	return document.getElementById(e);
}
var theta = -0.4; // 转角
var eleva = -0.1; // 仰角
var pad = g('pad');
var ctx = pad.getContext('2d');
ctx.translate(200, 200);
//ctx.scale(82, 82);
/* 将三维投射到二维（三维直角坐标系转平面直角坐标系） */
function iso(x, y, z) {
	var dist = Math.sqrt(x * x + y * y);
	var angle = (x == 0 && y == 0) ? 0 : Math.atan(y / x) + theta
			+ ((x < 0) ? Math.PI : 0);
	x = Math.cos(angle) * dist;
	y = -Math.sin(angle) * dist;
	var fact = (y * Math.cos(eleva) + z * Math.sin(eleva) + 8) / 8;
	y = y * Math.sin(eleva) - z * Math.cos(eleva);
	x *= fact;
	y *= fact;
	return {
		x : x,
		y : y
	};
}


function cuboid(){
	
	
	
	
}


function preview() {
	ctx.clearRect(-200, -200, 600, 600);
//	ctx.lineWidth = 0.008;
//	ctx.lineJoin = "round";
	ctx.strokeStyle = 'rgba(150,0,100,1)';
	var co;
	ctx.beginPath();
	cuboid();
	ctx.stroke();
};
preview();
/* 鼠标拖动控制 */
pad.onmousedown = function(e) {
	var x0 = e.clientX, y0 = e.clientY;
	document.onmousemove = function(e) {
		theta -= (x0 - (x0 = e.clientX)) / 100;
		eleva -= (y0 - (y0 = e.clientY)) / 100;
		theta %= Math.PI * 2;
		if (theta < 0)
			theta += Math.PI * 2;
		eleva %= Math.PI * 2;
		if (eleva < 0)
			eleva += Math.PI * 2;
		preview();
	}
	document.onmouseup = function(e) {
		document.onmousemove = null;
	}
}