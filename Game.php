<?php
class Game
{
    private $state;
    private $nextState;
    private $c;
    private $r; 

    public function __construct($initialState = array(array()))
    {
        $this->state = $initialState;
        $this->r = count($initialState);
        $this->c = count($initialState[0]);
        $this->nextState = $initialState;
    }

    public function getState()
    {
    	return $this->state;
    }

    public function getNextState()
    {
        for($y=0; $y < $this->r; $y++){
            for($x=0; $x < $this->c; $x++){
                $this->nextState[$y][$x] = $this->updateCellState($x, $y);
            }
        }
        return $this->nextState;
    }

    public function updateCellState($x, $y)
    {
        if($this->state[$y][$x] == 1){
            if(($this->countCellNeighbours($x, $y) < 2)||($this->countCellNeighbours($x, $y) > 3)){
                return 0;
            }
        }
        else{
            if($this->countCellNeighbours($x, $y) == 3){
                return 1;
            }
        }
        return $this->state[$y][$x];
    }

    public function countCellNeighbours($x, $y)
    {
        $neighbourCount = 0;

        for($j=-1; $j<=1; $j++){
            for($i=-1; $i<=1; $i++){
                try{
                    if($this->state[$y+$j][$x+$i] == 1){
                        {
                            if(!(($i==0) && ($j==0))){
                                $neighbourCount++;
                            }
                        }
                    }
                }
                catch(Exception $e){

                }
            }
        }

        return $neighbourCount;
    }

}
