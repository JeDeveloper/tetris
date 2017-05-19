#pragma once
#ifndef COORDS_H
#define COORDS_H
class Coords
{
public:
	Coords(int iX, int iY);
	Coords(const Coords & orig);
	~Coords();
	bool operator==(const Coords& other) const;
	bool operator!=(const Coords& other) const;
	Coords& operator+(const Coords& other);
	Coords& operator-(const Coords& other);
	Coords* add(Coords* a) const;
	const int x;
	const int y;
	static Coords& DOWN;
	static Coords& UP;
	static Coords& LEFT;
	static Coords& RIGHT;
	static Coords& IDENTITIY;
};
#endif

