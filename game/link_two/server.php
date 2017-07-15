<?php

class Link {

    private $xLength = 9;

    private $yLength = 7;

    //
    private $linkObj = array('A', 'B', 'C', 'D', 'E', 'F');

    //主界面框架数组，坐标点
    private $gameFrame = array();


    public function __construct()
    {

    }


    /**
     * @todo 生成主框架坐标点
     *
     * @return array
     */
    public function gameFrameInit()
    {
        for ($i = 0; $i < $this->xLength; $i++){
            for ($j = 0; $j < $this->yLength; $j++){
                array_push($this->gameFrame, array('x'=>$i, 'y'=>$j));
            }
        }
        return $this->gameFrame;
    }

    /**
     * @todo 填充坐标点
     */
    public function gameLinkInit($gameFrame)
    {
        foreach ($gameFrame as $item) {
            if ($item['x'] !== 4 || $item['y'] !== 3)
            {
                //随机生成一个连接对象
                $linkObj = array_rand($this->linkObj);
                //随机指定一个其他的坐标点






            }
        }
    }


    public function getLinkPath()
    {

    }

    /**
     * @todo 获取提示
     *
     * @param $gameFrame
     */
    public function getTips($gameFrame)
    {

    }


    /**
     * @todo 对地图进行重新排列
     *
     * @param $gameFrame
     */
    public function reload($gameFrame)
    {

    }


}

$test = new Link();

$f = $test->gameFrameInit();

$s_f = serialize($f);


echo $s_f;


//var_dump($test->gameFrameInit());