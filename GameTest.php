<?php
class GameTest extends PHPUnit_Framework_TestCase
{
    public function testGameInitialization_WithEmptyState()
    {
        $game = new Game();

        $state = $game->getState();

        $this->assertEquals($state, array(array()));
    }

    public function testGameIsInitialization_WithInitialState()
    {
    	$initialState = array(
            array(0,0,0,0),
            array(0,0,0,0),
            array(0,0,0,0),
            array(0,0,0,0)
            );

    	$game = new Game($initialState);

    	$state = $game->getState();

    	$this->assertEquals($state, $initialState);
    }

    public function testNeighbourCounting()
    {
        $initialState = array(
            array(1,1),
            array(0,1));

        $game = new Game($initialState);
        $neighbourCount = $game->countCellNeighbours(1,0);

        $this->assertEquals($neighbourCount, 2);
    }

    public function testNextState_NoEvolution()
    {
        $initialState = array(
            array(0,0,0,0,0,0,0,0),
            array(0,0,0,0,0,0,0,0),
            array(0,0,0,0,0,0,0,0),
            array(0,0,0,0,0,0,0,0));

        $game = new Game($initialState);

        $nextState = $game->getNextState();

        $this->assertEquals($initialState, $nextState);
    }

    public function testCellUpdtate_CellDies_Underpopulation()
    {
        $initialState = array(
            array(0,0,0),
            array(0,1,0),
            array(0,0,0));

        $game = new Game($initialState);

        $newCellState = $game->updateCellState(1,1);

        $this->assertEquals($newCellState, 0);
    }

    public function testCellUpdtate_CellDies_Overcrowding()
    {
        $initialState = array(
            array(1,1,1),
            array(1,1,0),
            array(0,0,0));

        $game = new Game($initialState);

        $newCellState = $game->updateCellState(1,1);

        $this->assertEquals($newCellState, 0);
    }

    public function testCellUpdtate_CellSurvives_TwoNeighbours()
    {
        $initialState = array(
            array(1,1),
            array(0,1));

        $game = new Game($initialState);

        $newCellState = $game->updateCellState(1,1);

        $this->assertEquals($newCellState, 1);
    }

    public function testCellUpdtate_CellSurvives_ThreeNeighbours()
    {
        $initialState = array(
            array(1,1),
            array(1,1));

        $game = new Game($initialState);

        $newCellState = $game->updateCellState(1,1);

        $this->assertEquals($newCellState, 1);
    }

    public function testCellUpdtate_CellPopulates()
    {
        $initialState = array(
            array(1,1),
            array(0,1));

        $game = new Game($initialState);

        $newCellState = $game->updateCellState(1,0);

        $this->assertEquals($newCellState, 1);
    }

    public function testNextState()
    {
        $initialState = array(
            array(1,1,0,0),
            array(0,1,1,0),
            array(1,1,0,1),
            array(0,1,1,0));

        $expectedState = array(
            array(1,1,1,0),
            array(0,0,0,0),
            array(1,0,0,1),
            array(1,1,1,0));

        $game = new Game($initialState);

        $newState = $game->getNextState();

        $this->assertEquals($newState, $expectedState);
    }

}
