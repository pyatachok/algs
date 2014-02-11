<?php

namespace Application\UF ;

	/**
	 * Union is too expensive. It takes N^2 array accesses
	 * to process a sequence of N union commands on N objects.
	 */
	class QuickFind extends UF
	{

	}
