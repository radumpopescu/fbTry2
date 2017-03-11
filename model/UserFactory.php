<?php

class UserFactory
{

    /**
     * Get all users
     * @return array
     */
    public static function getAll()
    {
        $users = [];
        $query = QB::table('user')
            ->orderBy('group', 'ASC')
            ->select("*");
        $results = $query->get();
        foreach ($results as $r) {
            $users[] = new User($r->id, $r);
        }
        return $users;
    }

    /**
     * Get all users in a specific group
     * @param $groupId
     * @return array
     */
    public static function getAllByGroup($groupId)
    {
        $users = [];
        $query = QB::table('user')->where('group', '=', $groupId);
        $results = $query->get();
        foreach ($results as $r) {
            $users[] = new User($r->id, $r);
        }
        return $users;
    }
}