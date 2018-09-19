<?php
/**
 * Created by PhpStorm.
 * User: tomekfabian
 * Date: 19.09.18
 * Time: 07:48
 */

namespace Toptal\Blog\Api\Data;


interface PostInterface
{


    /**
     * @return string|null
     */
    public function getTitle();

    /**
     * @return string|null
     */
    public function getContent();

    /**
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * @return string|null
     */
    public function getId();

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * @param string $content
     * @return $this
     */
    public function setContent($content);

    /**
     * @param int $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);
}