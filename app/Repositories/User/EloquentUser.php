<?php

/**
 * @file
 * EloquentUser
 *
 * All code is copyright by the original authors and released under the GNU Aferro General Public License version 3 (AGPLv3) or later.
 * See COPYRIGHT and LICENSE.
 */

namespace App\Repositories\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class EloquentUser implements UserInterface {

	/**
	* User
	*
	* @var App\Models\User;
	*
	*/
	protected $User;

	public function __construct(Model $User)
	{
		$this->User = $User;
	}

    /**
    * Retrieve list of user
    *
    * @param  int $id Organization id
    *
    * @return Illuminate\Database\Eloquent\Collection
    */
    public function paginate()
    {

    }

    /**
     * Get an user by id
    *
    * @param  int $id
    *
    * @return Mgallegos\DecimaAccounting\Account
    */
    public function byId($id)
    {
        return $this->User->find($id);
    }

    /**
     * Create a new User
    *
    * @param array $data
    * 	An array as follows: array('field0'=>$field0, 'field1'=>$field1);
    *
    * @return App\Models\User $User
    */
    public function create(array  $data)
    {
        $user = new User();
        $user->fill($data)->save();

        return $user;
    }

    /**
     * Update an existing User
    *
    * @param array $data
    * 	An array as follows: array('field0'=>$field0, 'field1'=>$field1);
    *
    * @param App\Models\User $user
    *
    * @return boolean
    */
    public function update(array $data, $user = null)
    {
        if(empty($user))
        {
            $user = $this->byId($data['id']);
        }

        foreach ($data as $key => $value)
        {
            $user->$key = $value;
        }

        return $user->save();
    }

    /**
     * Delete existing User
    *
    * @param integer $id
    * 	An user id
    *
    * @return boolean
    */
    public function delete(array $ids)
    {
        return $this->User->destroy($ids);
    }
}
