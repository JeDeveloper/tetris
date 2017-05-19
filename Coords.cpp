#include "Coords.h"
Coords& Coords::DOWN = Coords(0, -1);
Coords& Coords::UP = Coords(0, 1);
Coords& Coords::LEFT = Coords(-1, 0);
Coords& Coords::RIGHT = Coords(1, 0);
Coords& Coords::IDENTITIY = Coords(0, 0);

Coords::Coords(int iX, int iY) : x(iX), y(iY)
{

}

Coords::Coords(const Coords & orig) : x(orig.x), y(orig.y)
{

}

Coords::~Coords()
{

}

bool Coords::operator==(const Coords& other) const
{
	return other.x == x && other.y == y;
}

bool Coords::operator!=(const Coords& other) const
{
	return other.x != x || other.y != y;
}

Coords& Coords::operator+(const Coords& other)
{
	Coords& ret = Coords(x + other.x, y + other.y);
	return ret;
}

Coords& Coords::operator-(const Coords& other)
{
	int nX = x - other.x;
	int nY = y - other.y;
	Coords& ret = Coords(nX, nY);
	return ret;
}

Coords* Coords::add(Coords* a) const
{
	Coords* b = new Coords(a->x + x, a->y + y);
	delete a;
	return b;
}

