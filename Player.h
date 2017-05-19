#pragma once
#include "MoveType.h"
#ifndef PLAYER_H
#define PLAYER_H
class Game; //Forward Declaration
class Player
{
public:
	Player();
	~Player();
	virtual MoveType chooseMove(Game* game) = 0;
};

#endif