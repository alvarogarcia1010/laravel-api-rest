<?php

/**
 * @file
 * EloquentMarriage
 *
 * All code is copyright by the original authors and released under the GNU Aferro General Public License version 3 (AGPLv3) or later.
 * See COPYRIGHT and LICENSE.
 */

namespace App\Repositories\Marriage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Marriage;

class EloquentMarriage implements MarriageInterface {

	/**
	* Marriage
	*
	* @var App\Models\Marriage;
	*
	*/
	protected $Marriage;

	public function __construct(Model $Marriage)
	{
		$this->Marriage = $Marriage;
	}

    /**
    * Retrieve list of marriage
    *
    * @param  int $id Organization id
    *
    * @return Illuminate\Database\Eloquent\Collection
    */
    public function searchTableRowsWithPagination($count = false, $limit = null, $offset = null, $filter = null, $sortColumn = null, $sortOrder = null)
    {
        $query = $this->Marriage->select('*');

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
     * Get an marriage by id
    *
    * @param  int $id
    *
    * @return App\Models\Marriage $Marriage
    */
    public function byId($id)
    {
        return $this->Marriage->find($id);
    }

    /**
     * Create a new Marriage
    *
    * @param array $data
    * 	An array as follows: array('field0'=>$field0, 'field1'=>$field1);
    *
    * @return App\Models\Marriage $Marriage
    */
    public function create(array  $data)
    {
        $marriage = new Marriage();
        $marriage->fill($data)->save();

        return $marriage;
    }

    /**
     * Update an existing marriage
    *
    * @param array $data
    * 	An array as follows: array('field0'=>$field0, 'field1'=>$field1);
    *
    * @param App\Models\Marriage $marriage
    *
    * @return boolean
    */
    public function update(array $data, $marriage = null)
    {
        if(empty($marriage))
        {
            $marriage = $this->byId($data['id']);
        }

        return $marriage->update($data);
    }

    /**
     * Delete existing Marriage
    *
    * @param integer $id
    * 	An marriage id
    *
    * @return boolean
    */
    public function delete($id)
    {
        return $this->Marriage->destroy($id);
    }
}
