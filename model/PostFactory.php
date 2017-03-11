<?php

class PostFactory
{
    /**
     * Returns all posts written by members of a specific group
     * @param $group
     * @return array
     */
    public static function getAllByGroup($group)
    {
        $posts = [];
        $query = QB::table('post')
            ->join('user', 'user.id', '=', 'post.user')
            ->where('user.group', '=', $group)
            ->orderBy('created', 'DESC')
            ->select(["post.*", "user.name"]);
        $results = $query->get();
        foreach ($results as $r) {
            $posts[] = new Post($r->id, $r);
        }
        return $posts;
    }

    /**
     * Returns all posts written by members of a specific group containing search term
     * @param $group
     * @return array
     */
    public static function filterAllByGroup($group, $search)
    {
        $posts = [];
        $query = QB::table('post')
            ->join('user', 'user.id', '=', 'post.user')
            ->where('user.group', '=', $group)
            ->where('content', 'LIKE', '%' . $search . '%')
            ->orderBy('created', 'DESC')
            ->select(["post.*", "user.name"]);
        $results = $query->get();
        foreach ($results as $r) {
            $posts[] = new Post($r->id, $r);
        }
        return $posts;
    }
}
