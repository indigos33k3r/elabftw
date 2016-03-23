<?php
/**
 * \Elabftw\Elabftw\Entity
 *
 * @author Nicolas CARPi <nicolas.carpi@curie.fr>
 * @copyright 2012 Nicolas CARPi
 * @see http://www.elabftw.net Official website
 * @license AGPL-3.0
 * @package elabftw
 */
namespace Elabftw\Elabftw;

use \Exception;

/**
 * The mother class of Experiments and Database
 */
class Entity
{

    /** id of our entity */
    protected $id;

    /**
     * Check and set id
     *
     * @param int $id
     */
    public function setId($id)
    {
        if (Tools::checkId($id) === false) {
            throw new Exception(_('The id parameter is not valid!'));
        }
        $this->id = $id;
    }

    /**
     * Check if an item has a file attached.
     *
     * @return bool Return false if there is now file attached
     */
    public function hasAttachment($type)
    {
        $sql = "SELECT id FROM uploads
            WHERE item_id = :item_id AND type = :type LIMIT 1";
        $req = $this->pdo->prepare($sql);
        $req->bindParam(':item_id', $this->id);
        $req->bindParam(':type', $type);
        $req->execute();

        return $req->rowCount() > 0;
    }
}
