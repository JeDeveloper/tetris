#pragma once
#ifndef BLOCK_H
#define BLOCK_H
#include "Coords.h"
const int BLOCK_SIZE = 4;
const int NUM_BLOCKS = 7;
class Block
{
public:
	Block() = delete;
	Block(const Block& blk);
	Block(Coords** sqrs);
	~Block();
	Coords** getCells() const;
	Coords* getCell(int idx) const;
	Coords* getCellGlobal(int idx, Coords* base);
	bool contains(const Coords* point) const;
	void rotate(bool left); //defaults to right because why not?

	static Block* BLOCK_TYPES[];
private:
	Coords** m_pCells;
};
Block* getRandBlock();
#endif