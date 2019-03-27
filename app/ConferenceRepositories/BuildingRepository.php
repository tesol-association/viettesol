<?php

namespace App\ConferenceRepositories;
use App\Models\Buildings;

class BuildingRepository
{
	public function all()
	{
		return Buildings::all();
	}

	public function find($buildingId)
	{
		return Buildings::find($buildingId);
	}

	public function get($filters = null)
	{
		if (empty($filters)) {
            $building = Buildings::all();
        } else {
            $conditions = [];
            foreach ($filters as $key => $filter) {
                $conditions[] = [$key, '=', $filter];
            }
            $building = Buildings::where($conditions)->get();
        }
        return $building;
	}

	public function create($data)
	{
		$building = new Buildings();
		
		$building->name = $data['name'];
        $building->abbrev = $data['abbrev'];
        $building->description = $data['description'];
        $building->conference_id = $data['conference_id'];

        $building->save();

        return $building;
	}

	public function update($id, $data)
	{
		$building = Buildings::find($id);

		$building->name = $data['name'];
        $building->abbrev = $data['abbrev'];
        $building->description = $data['description'];

        $building->save();

        return $building;
	}

	public function destroy($id)
	{
		$building = Buildings::find($id);

        foreach ($building->rooms as $room) {
            $room->delete();
        }

        $building->delete();

        return $building;
	}
}