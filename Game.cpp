#include "Game.h"
#define HEIGHT 20
#define WIDTH 10

using namespace std;

Coords Game::START_COORDS = Coords(WIDTH / 2 - 1, HEIGHT - 1);

Game::Game()
{
	m_ppbPlayField = new bool*[HEIGHT];
	for (int y = 0; y < HEIGHT; y++)
	{
		m_ppbPlayField[y] = new bool[WIDTH];
		for (int x = 0; x < WIDTH; x++)
		{
			m_ppbPlayField[y][x] = false;
		}
	}
}


Game::~Game()
{
	delete m_ActiveBlock;
	delete m_ActiveBlockCoords;
	for (int i = 0; i < HEIGHT; i++)
	{
		delete m_ppbPlayField[i];
	}
	delete m_ppbPlayField;
}

void Game::play(Player* p)
{
	//char c = ' ';
	while (!isGameOver())
	{
		step();
		output(cout);
		MoveType move = p->chooseMove(this);
		if (!doesMoveIntersect(move))
			moveActiveBlock(move);
		//cin >> c; //Just wait for an input. For debugging
	}
}

void Game::step()
{
	if (m_ActiveBlock == NULL)
	{
		addBlock(getRandBlock());
	}

	if (doesMoveIntersect(&Coords::DOWN))
	{
		for (int i = 0; i < BLOCK_SIZE; i++)
		{
			Coords* coords = getActiveBlock()->getCell(i)->add(new Coords(*getActiveBlockCoords()));
			if (!isOutOfBounds(coords))
				setCell(coords, true);
		}
		delete m_ActiveBlock;
		m_ActiveBlock = NULL;
	}
	else {
		moveActiveBlock(Coords::DOWN);
	}
}

bool Game::isGameOver() const
{
	if (getCell(&START_COORDS))
		return true;
	if (getActiveBlock() == NULL || !doesMoveIntersect(&Coords::DOWN))
		return false;
	for (int i = 0; i < BLOCK_SIZE; i++)
	{
		Coords* cell = new Coords(*getActiveBlock()->getCell(i));
		if (isOutOfBounds(getActiveBlockCoords()->add(cell)))
			return true;
	}
	return false;
}

bool Game::doesMoveIntersect(const Coords* move) const
{
	if (m_ActiveBlock == NULL)
		return false;
	for (int i = 0; i < BLOCK_SIZE; i++)
	{
		Coords* cell = new Coords(*getActiveBlock()->getCell(i)); //'cell' is currently in the local space
		cell = getActiveBlockCoords()->add(cell); //'cell' is now in the global space
		cell = move->add(cell); //'cell' is still in the global space
		if (getZone(cell) == Coords::UP)
			continue;
		bool isOut = isOutOfBounds(cell);
		if (isOut || getCell(cell))
			return true;
	}
	return false;
}

bool Game::doesRotIntersect(bool bLeft) const
{
	if (m_ActiveBlock == NULL)
		return false;
	Block* copy = new Block(*getActiveBlock());
	copy->rotate(bLeft);
	for (int i = 0; i < BLOCK_SIZE; i++)
	{
		Coords* cell = new Coords(*copy->getCell(i)); //'cell' is currently in the local space
		cell = getActiveBlockCoords()->add(cell); //'cell' is now in the global space
		if (getZone(cell) == Coords::UP)
			continue;
		if (isOutOfBounds(cell) || getCell(cell))
			return true;
	}
	return false;
}

bool Game::doesMoveIntersect(MoveType move) const
{
	switch (move)
	{
	case MOVE_UP:
		return doesMoveIntersect(&Coords::UP);
	case MOVE_DOWN:
		return doesMoveIntersect(&Coords::DOWN);
	case MOVE_LEFT:
		return doesMoveIntersect(&Coords::LEFT);
	case MOVE_RIGHT:
		return doesMoveIntersect(&Coords::RIGHT);
	case MOVE_ROT_LEFT:
		return doesRotIntersect(true);
	case MOVE_ROT_RIGHT:
		return doesRotIntersect(false);
	}
	return false;
}

bool Game::getCell (int x, int y) const
{
	return m_ppbPlayField[y][x];
}

bool Game::getCell(const Coords* coords) const
{
	return getCell(coords->x, coords->y);
}

void Game::setCell(int x, int y, bool bNewVal)
{
	m_ppbPlayField[y][x] = bNewVal;
}

void Game::setCell(const Coords* coords, bool bNewVal)
{
	setCell(coords->x, coords->y, bNewVal);
}

Block* Game::getActiveBlock() const
{
	return m_ActiveBlock;
}

void Game::moveActiveBlock(Coords move)
{
	m_ActiveBlockCoords = move.add(getActiveBlockCoords());
}

void Game::moveActiveBlock(MoveType move)
{
	switch (move)
	{
	case MOVE_UP:
		m_ActiveBlockCoords = m_ActiveBlockCoords->add(new Coords(Coords::UP));
		break;
	case MOVE_DOWN:
		m_ActiveBlockCoords = m_ActiveBlockCoords->add(new Coords(Coords::DOWN));
		break;
	case MOVE_LEFT:
		m_ActiveBlockCoords = m_ActiveBlockCoords->add(new Coords(Coords::LEFT));
		break;
	case MOVE_RIGHT:
		m_ActiveBlockCoords = m_ActiveBlockCoords->add(new Coords(Coords::RIGHT));
		break;
	case MOVE_ROT_LEFT:
		m_ActiveBlock->rotate(true);
		break;
	case MOVE_ROT_RIGHT:
		m_ActiveBlock->rotate(false);
		break;
	}
}

bool Game::isOutOfBounds(Coords* c) const
{
	return c->x >= WIDTH || c->x < 0 || c->y >= HEIGHT || c->y < 0;
}

Coords& Game::getZone(Coords* c) const
{
	if (c->x >= WIDTH)
		return Coords::RIGHT;
	if (c->x < 0)
		return Coords::LEFT;
	if (c->y >= HEIGHT)
		return Coords::UP;
	if (c->y < 0)
		return Coords::DOWN;
	return Coords::IDENTITIY;
}

void Game::addBlock(Block* blk)
{
	if (m_ActiveBlockCoords != NULL)
		delete m_ActiveBlockCoords;
	if (m_ActiveBlock != NULL)
		delete m_ActiveBlock;
	m_ActiveBlock = new Block(*blk);
	m_ActiveBlockCoords = new Coords(START_COORDS.x, START_COORDS.y);

}

Coords* Game::getActiveBlockCoords() const
{
	return m_ActiveBlockCoords;
}

void Game::output(ostream& output) const
{
	for (int y = HEIGHT - 1; y > -1; y--)
	{
		for (int x = 0; x < WIDTH; x++)
		{
			Coords* curr = new Coords(x, y);
			if (getCell(curr))
			{
				output << "X ";
				continue;
			}

			if (*curr == *getActiveBlockCoords())
			{
				output << "O ";
				continue;
			}
			bool inBounds = !isOutOfBounds(curr);
			Coords* rel = new Coords(x - getActiveBlockCoords()->x, y - getActiveBlockCoords()->y); //'cell' in the local space of 'm_ActiveBlock'
			if (getActiveBlock() == NULL)
			{
				output << "_ ";
				continue;
			}
			bool contains = getActiveBlock()->contains(rel);
			if (inBounds && contains)
				output << "X ";
			else
				output << "_ ";
			delete curr;
			delete rel;
		}
		output << endl;
	}
	for (int i = 0; i < WIDTH; i++)
	{
		cout << "--";
	}
	cout << endl;
}