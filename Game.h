#pragma once
#ifndef GAME_H
#define GAME_H
#include <fstream>
#include <iostream>
#include <vector>
#include <cstdlib>
#include <ctime>
#include "Block.h"
#include "Player.h"
#include "MoveType.h"

class Game
{
public:
	Game();
	~Game();
	bool getCell(int x, int y) const;
	bool getCell(const Coords* coords) const;
	void setCell(int x, int y, bool bNewVal);
	void setCell(const Coords* coords, bool bNewVal);
	Block* getActiveBlock() const;
	Coords* getActiveBlockCoords() const;
	void moveActiveBlock(Coords move);
	void moveActiveBlock(MoveType move);
	void addBlock(Block* blk);
	void play(Player* p);
	void step();
	bool isGameOver() const;
	bool doesMoveIntersect(const Coords* move) const;
	bool doesRotIntersect(bool bLeft) const;
	bool doesMoveIntersect(MoveType move) const;
	void output(std::ostream& output) const;
	bool isOutOfBounds(Coords* c) const;
	Coords& getZone(Coords* c) const; //Returns whether c is within the board, or if not, which side it is on, represented by a Coords object
	static Coords START_COORDS;
protected:
	bool** m_ppbPlayField;
	Block* m_ActiveBlock;
	Coords* m_ActiveBlockCoords;
};
#endif

