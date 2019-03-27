<?php

namespace App\ConferenceRepositories;
use App\Models\Rooms;

class RoomRepository
{
	public function all()
	{
		return Rooms::all();
	}

	public function find($roomId)
	{
		return Rooms::find($roomId);
	}

	public function get($filters = null)
	{
		if (empty($filters)) {
            $rooms = Rooms::with('building')->get();
        } else {
            $conditions = [];
            foreach ($filters as $key => $filter) {
                $conditions[] = [$key, '=', $filter];
            }
            $rooms = Rooms::with('building')->where($conditions)->get();
        }
        return $rooms;
	}

	public function create($data)
	{
		$room = new Rooms();

		$room->name = $data['name'];
        $room->abbrev = $data['abbrev'];
        $room->description = $data['description'];
        $room->building_id = $data['building_id'];

        $room->save();

        return $room;
	}

	public function update($id, $data)
	{
		$room = Rooms::find($id);

		$room->name = $data['name'];
        $room->abbrev = $data['abbrev'];
        $room->description = $data['description'];

        $room->save();
        
        return $room;
	}

	public function destroy($id)
	{
		$room = Rooms::find($id);

        $room->delete();

        return $room;
	}
}