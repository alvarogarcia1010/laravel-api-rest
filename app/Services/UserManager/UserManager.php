<?php
/**
 * @file
 * User Management Interface Implementation.
 *
 * All ModuleName code is copyright by the original authors and released under the GNU Aferro General Public License version 3 (AGPLv3) or later.
 * See COPYRIGHT and LICENSE.
 */

namespace App\Services\UserManager;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Repositories\User\UserInterface;
use Carbon\Carbon;

class UserManager implements UserManagementInterface {

    /**
	* User
	*
	* @var App\Repositories\User\UserInterface;
	*
	*/
    protected $User;

    /**
    * Carbon instance
    *
    * @var Carbon\Carbon
    *
    */
    protected $Carbon;

	public function __construct(
        UserInterface $User,
        Carbon $Carbon
    )
	{
        $this->User = $User;
		$this->Carbon = $Carbon;
    }

}
