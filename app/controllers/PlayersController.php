<?php

class PlayersController extends ApiController {

	/**
	 * Display a listing of players
	 *
	 * @return Response
	 */
	public function index()
	{
		$players = Player::all();

		if (count($players) === 0)
		{
			return $this->respondNotFound('No players exist.');
		}

		return $this->respond([
	        'data' => $players->toArray()
	    ]);
	}


	/**
	 * Store a newly created player in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();

		$validator = Validator::make($data, Player::$rules);

		if ($validator->fails())
		{
			return $this->respondBadRequest('Validation fails.', $validator->messages()->toArray());
		}

		$player = Player::create($data);

		return $this->respondCreated('Player successfully created.');
	}

	/**
	 * Display the specified player.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$player = Player::find($id);

		if ( ! $player) 
		{
			return $this->respondNotFound('Player does not exist.');
		}

		return $this->respond([
	        'data' => $player->toArray()
	    ]);
	}


	/**
	 * Update the specified player in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = Input::all();

		$validator = Validator::make($data, player::$rules);

		if ($validator->fails())
		{
			return $this->respondBadRequest('Validation fails.', $validator->messages()->toArray());
		}

		$player = Player::find($id);

		$player->update($data);

		return $this->respondCreated('Player successfully updated.');
	}

	/**
	 * Remove the specified player from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Player::destroy($id);

		return $this->respondCreated('Player successfully deleted.');
	}

}
