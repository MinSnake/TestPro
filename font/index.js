//canvas对象-600*600
var c= document.getElementById("myCanvas");
var ctx=c.getContext("2d");
//40mm是39.6x27.8x20
function create_mj(x,y,l,h){
	ctx.strokeStyle="#1DB56A";
	for(var i=60;i>0;i--){
		x = x-1;
		y = y+1;
		if(i < 40){
			ctx.strokeStyle="#FFFFFF";
		}
		ctx.strokeRect(x,y,280,400);
		ctx.clearRect(x-1,y+1,280,400);
	}
	ctx.strokeStyle="#FFFFFF";//设置画笔的颜色
	ctx.fillStyle="#FFFFFF";
	ctx.fillRect(x,y,280,400);//画个矩形
}
create_mj(200,50,280,400);
//加个字
ctx.font="280px Georgia";
ctx.fillStyle="#1DB56A";//设置画笔的颜色
ctx.fillText("發",140,410);