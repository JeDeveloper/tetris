#include "HumanPlayer.h"
#include "Game.h"
#include <iostream>

int main(int numArgs, char** args)
{
	srand(time(NULL));
	Game gc = Game();
	Player* p = new HumanPlayer();
	gc.play(p);
	delete p;
	system("pause");
}


HumanPlayer::HumanPlayer()
{
}


HumanPlayer::~HumanPlayer()
{
}

MoveType HumanPlayer::chooseMove(Game* g)
{
	char input;
	while (true) //Or, in other words, until the loop breaks
	{
		std::cin >> input;
		switch (input)
		{
		case 's':
			return MOVE_DOWN;
		case 'a':
			return MOVE_LEFT;
		case 'd':
			return MOVE_RIGHT;
		case 'q':
			return MOVE_ROT_LEFT;
		case 'e':
			return MOVE_ROT_RIGHT;
		}
	}
}
