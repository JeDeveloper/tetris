#include "Block.h"
#include <cstdlib>
#include <array>

Block* Block::BLOCK_TYPES[NUM_BLOCKS] = {
	new Block(new Coords*[BLOCK_SIZE]{ new Coords(0, 0), new Coords(0, 1), new Coords(0, 2), new Coords(0, 3) }), //Line block
	new Block(new Coords*[BLOCK_SIZE]{ new Coords(0, 0), new Coords(0, 1), new Coords(1, 1), new Coords(1, 0) }), //Square Block
	new Block(new Coords*[BLOCK_SIZE]{ new Coords(0, 0), new Coords(0, 1), new Coords(0, 2), new Coords(1, 2) }), //L block
	new Block(new Coords*[BLOCK_SIZE]{ new Coords(0, 0), new Coords(0, 1), new Coords(0, 2), new Coords(-1, 2) }), //R block
	new Block(new Coords*[BLOCK_SIZE]{ new Coords(0, 0), new Coords(1, 0), new Coords(1, 1), new Coords(2, 1) }), //Z block
	new Block(new Coords*[BLOCK_SIZE]{ new Coords(-1, 0), new Coords(0, 0), new Coords(0, 1), new Coords(1, 1) }), //S block
	new Block(new Coords*[BLOCK_SIZE]{ new Coords(0, 0), new Coords(1, 0), new Coords(2, 0), new Coords(1, 1) }), //T block
};

Block::Block(const Block& blk) : m_pCells(blk.getCells())
{
	m_pCells = new Coords*[BLOCK_SIZE];
	for (int i = 0; i < BLOCK_SIZE; i++)
	{
		m_pCells[i] = new Coords(*blk.getCell(i));
	}
}

Block::Block(Coords** sqrs) : m_pCells(sqrs)
{

}

Block::~Block()
{
	for (int i = 0; i < BLOCK_SIZE; i++)
	{
		delete m_pCells[i];
	}
}

Coords** Block::getCells() const
{
	return m_pCells;
}

Coords* Block::getCell(int idx) const
{
	return m_pCells[idx];
}

bool Block::contains(const Coords* point) const
{
	for (int i = 0; i < BLOCK_SIZE; i++)
	{
		const Coords* cell = getCell(i);
		if (*cell == *point) //May or may not work... Must check
			return true;
	}
	return false;
}

Coords* Block::getCellGlobal(int idx, Coords* base)
{
	Coords* cell = new Coords(*getCell(idx));
	return base->add(cell);
}

void Block::rotate(bool bLeft) //To be implemented later
{
	for (int i = 0; i < BLOCK_SIZE; i++)
	{
		Coords* curr = getCell(i);
		int newX = curr->y;
		int newY = curr->x;
		bool bQuad1 = curr->x >= 0 && curr->y >= 0;
		bool bQuad3 = curr->x <= 0 && curr->y <= 0;
		if (!bLeft)
		{
			newY = -newY;
		}
		else
		{
			newX = -newX;
		}
		m_pCells[i] = new Coords(newX, newY);
	}
}

Block* getRandBlock()
{
	int idx = rand() % NUM_BLOCKS;
	Block* blk = new Block(*Block::BLOCK_TYPES[idx]);
	return blk;
}