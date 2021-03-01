<?php

/**
 * @file
 * EloquentBaptism
 *
 * All code is copyright by the original authors and released under the GNU Aferro General Public License version 3 (AGPLv3) or later.
 * See COPYRIGHT and LICENSE.
 */

namespace App\Repositories\Baptism;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Baptism;

class EloquentBaptism implements BaptismInterface {

	/**
	* Baptism
	*
	* @var App\Models\Baptism;
	*
	*/
	protected $Baptism;

	public function __construct(Model $Baptism)
	{
		$this->Baptism = $Baptism;
	}

    /**
    * Retrieve list of baptism
    *
    * @param  int $id Organization id
    *
    * @return Illuminate\Database\Eloquent\Collection
    */
    public function searchTableRowsWithPagination($count = false, $limit = null, $offset = null, $filter = null, $sortColumn = null, $sortOrder = null)
    {
        $query = $this->Baptism->select('*');

        if(!empty($filter))
        {
          $query->where(function($dbQuery) use ($filter)
          {
            foreach (['name', 'father_name', 'mother_name', 'godfather_name', 'godmother_name'] as $key => $value)
            {
                $dbQuery->orWhere($value, 'like', '%' . str_replace(' ', '%', $filter) . '%');
                //$dbQuery->orwhereRaw('lower(`' . $value . '`) LIKE ? ',['%' . strtolower(str_replace(' ', '%', $filter)) . '%']);
            }
          });
        }

        if(!empty($sortColumn) && !empty($sortOrder))
        {
          $query->orderBy($sortColumn, $sortOrder);
        }

        if($count)
        {
            return $query->count();
        }

        if(!empty($limit))
        {
            $query->take($limit);
        }

        if(!empty($offset) && $offset != 0)
        {
            $query->skip($offset);
        }
        return new Collection(
            $query->get()
        );
    }

    /**
     * Get an baptism by id
    *
    * @param  int $id
    *
    * @return App\Models\Baptism $Baptism
    */
    public function byId($id)
    {
        return $this->Baptism->find($id);
    }

    /**
     * Create a new Baptism
    *
    * @param array $data
    * 	An array as follows: array('field0'=>$field0, 'field1'=>$field1);
    *
    * @return App\Models\Baptism $Baptism
    */
    public function create(array  $data)
    {
        $baptism = new Baptism();
        $baptism->fill($data)->save();

        return $baptism;
    }

    /**
     * Update an existing baptism
    *
    * @param array $data
    * 	An array as follows: array('field0'=>$field0, 'field1'=>$field1);
    *
    * @param App\Models\Baptism $baptism
    *
    * @return boolean
    */
    public function update(array $data, $baptism = null)
    {
        if(empty($baptism))
        {
            $baptism = $this->byId($data['id']);
        }

        return $baptism->update($data);
    }

    /**
     * Delete existing Baptism
    *
    * @param integer $id
    * 	An baptism id
    *
    * @return boolean
    */
    public function delete($id)
    {
        return $this->Baptism->destroy($id);
    }
}
