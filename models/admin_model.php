<?php

class Admin extends Model
{
	/**
	 * Ulanyjynyn admin bolup bolmadygyny barlayar. Egerde admin bolsa true, bolmasa false beryar
	 * 
	 * @param int $user_id user_id
	 * @return bool true or false
	 * @author Agamyrat C.
	 * 
	 */
	public static function isAdmin($user_id)
	{
		$db = new Database;
		try {
			$sql = 'SELECT ISADMIN FROM users WHERE (USER_ID = ?) LIMIT 1';
			$query = $db->prepare($sql);
			$query->execute([$user_id]);
			return $query->fetch()[0] == 2;
		} catch (Exception $e) {
			echo $e;
		}
		return false;
	}


	/**
	 * Ulanyjynyn moderator bolup bolmadygyny barlayar. Egerde moderator bolsa true, bolmasa false beryar
	 * 
	 * @param int $user_id user_id
	 * @return bool true or false
	 * @author Agamyrat C.
	 * 
	 */
	public static function isModerator($user_id)
	{
		$db = new Database;
		try {
			$sql = 'SELECT ISADMIN FROM users WHERE (USER_ID = ?) LIMIT 1';
			$query = $db->prepare($sql);
			$query->execute([$user_id]);
			return $query->fetch()[0] == 1;
		} catch (Exception $e) {
			echo $e;
		}
		return false;
	}


	/**
	 * Ulanyjynyn admin belleyar. DYKKATLY ULANMALY
	 * 
	 * @param int $user_id user_id
	 * @return int user_id gaytaryar
	 * @author Agamyrat C.
	 * 
	 */
	public static function setAdmin($user_id)
	{
		$db = new Database;
		try {
			$sql = 'UPDATE users SET ISADMIN = \'2\' WHERE (USER_ID = ?) LIMIT 1';
			$query = $db->prepare($sql);
			$query->execute([$user_id]);
			return $user_id;
		} catch (Exception $e) {
			echo $e;
		}
		return false;
	}



	/**
	 * Ulanyjynyn moderator belleyar. DYKKATLY ULANMALY
	 * 
	 * @param int $user_id user_id
	 * @return int user_id gaytaryar
	 * @author Agamyrat C.
	 * 
	 */
	public static function setModerator($user_id)
	{
		$db = new Database;
		try {
			$sql = 'UPDATE users SET ISADMIN = \'1\' WHERE (USER_ID = ?) LIMIT 1';
			$query = $db->prepare($sql);
			$query->execute([$user_id]);
			return $user_id;
		} catch (Exception $e) {
			echo $e;
		}
		return false;
	}



	/**
	 * Public edilip edilmejegine karar bermek. is_public 1e den bolan (ulanyjy public etmek isleyan testini) is_allowed rugsat berilip berilmejegini sazlayar.
	 * 
	 * UNS BERIN RUGSAT BERME DINE IS_PUBLIC = 1 BOLANLAR UCIN DIR.
	 * 
	 * @param int $test_id test ID-sy
	 * @param bool $access true-rugsat berilyar, false-rugsat berilmedi.
	 * @param string $description Sozlem hem ugradyp biler, egerde name ucin alynmajagyny yada alynany barada
	 * @param int $modified_user rugsady kim berdi, yada iptal kim etdi shol user id
	 * @return int test_id 
	 * @author Agamyrat C.
	 * 
	 */
	public static function accessPublicTest($test_id, $access, $description = '', $modified_user)
	{
		$db = new Database;
		try {
			if ($access) {
				$sql = 'UPDATE tests SET IS_ALLOWED = \'1\' WHERE ((TEST_ID = :test_id) AND (IS_PUBLIC = 1)) LIMIT 1';
				$sql_notif = 'INSERT INTO notifications (USER_ID, TEST_ID, SENDING_USER_ID, DESCRIPTION, NOTIFICATION_TYPE)
							  SELECT CREATED_BY, TEST_ID, :sending_user_id, :description, 1 FROM tests WHERE (TEST_ID = :test_id) LIMIT 1';
			} else {
				$sql = 'UPDATE tests SET IS_ALLOWED = \'0\', IS_PUBLIC = 0  WHERE ((TEST_ID = :test_id) AND (IS_PUBLIC = 1)) LIMIT 1';
				$sql_notif = 'INSERT INTO notifications (USER_ID, TEST_ID, SENDING_USER_ID, DESCRIPTION, NOTIFICATION_TYPE)
							  SELECT CREATED_BY, TEST_ID, :sending_user_id, :description, 2 FROM tests WHERE (TEST_ID = :test_id) LIMIT 1';
			}
			$query = $db->prepare($sql);
			$query->execute([':test_id' => $test_id]);

			$query = $db->prepare($sql_notif);
			$query->execute([
				':test_id' => $test_id,
				':sending_user_id' => $modified_user,
				':description' => $description
			]);

			return $test_id;
		} catch (Exception $e) {
			echo $e;
		}
		return false;
	}
}