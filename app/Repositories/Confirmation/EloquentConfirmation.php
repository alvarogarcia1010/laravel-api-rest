<?php

/**
 * @file
 * EloquentConfirmation
 *
 * All code is copyright by the original authors and released under the GNU Aferro General Public License version 3 (AGPLv3) or later.
 * See COPYRIGHT and LICENSE.
 */

namespace App\Repositories\Confirmation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Confirmation;

class EloquentConfirmation implements ConfirmationInterface {

	/**
	* Confirmation
	*
	* @var App\Models\Confirmation;
	*
	*/
	protected $Confirmation;

	public function __construct(Model $Confirmation)
	{
		$this->Confirmation = $Confirmation;
	}

    /**
    * Retrieve list of confirmation
    *
    * @param  int $id Organization id
    *
    * @return Illuminate\Database\Eloquent\Collection
    */
    public function searchTableRowsWithPagination($count = false, $limit = null, $offset = null, $filter = null, $sortColumn = null, $sortOrder = null)
    {
        $query = $this->Confirmation->select('*');

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
     * Get an confirmation by id
    *
    * @param  int $id
    *
    * @return App\Models\Confirmation $Confirmation
    */
    public function byId($id)
    {
        return $this->Confirmation->find($id);
    }

    /**
     * Create a new Confirmation
    *
    * @param array $data
    * 	An array as follows: array('field0'=>$field0, 'field1'=>$field1);
    *
    * @return App\Models\Confirmation $Confirmation
    */
    public function create(array  $data)
    {
        $confirmation = new Confirmation();
        $confirmation->fill($data)->save();

        return $confirmation;
    }

    /**
     * Update an existing confirmation
    *
    * @param array $data
    * 	An array as follows: array('field0'=>$field0, 'field1'=>$field1);
    *
    * @param App\Models\Confirmation $confimation
    *
    * @return boolean
    */
    public function update(array $data, $confirmation = null)
    {
        if(empty($confirmation))
        {
            $confirmation = $this->byId($data['id']);
        }

        return $confirmation->update($data);
    }

    /**
     * Delete existing Confirmation
    *
    * @param integer $id
    * 	An confirmation id
    *
    * @return boolean
    */
    public function delete($id)
    {
        return $this->Confirmation->destroy($id);
    }
}
