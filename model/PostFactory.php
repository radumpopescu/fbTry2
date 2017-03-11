<?php

class PostFactory
{
    public static function getAllByGroup($group)
    {
        $posts = [];
        $query = QB::table('post')
            ->join('user', 'user.id', '=', 'post.user')
            ->where('user.group', '=', $group)
            ->orderBy('created', 'DESC')
            ->select(["post.*", "user.name"]);
        $results = $query->get();
        foreach ($results as $r){
            $posts[] = new Post($r->id, $r);
        }
        return $posts;
    }

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
        foreach ($results as $r){
            $posts[] = new Post($r->id, $r);
        }
        return $posts;
    }
}