<?php

/**
 * VCWeb Networks <https://www.vcwebnetworks.com.br/>
 *
 * @author    Vagner Cardoso <vagnercardosoweb@gmail.com>
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @copyright 31/05/2019 Vagner Cardoso
 */

namespace Core\Password {

    /**
     * Class Password
     *
     * @package Core\Contracts
     * @author  Vagner Cardoso <vagnercardosoweb@gmail.com>
     */
    abstract class Password
    {
        /**
         * @param string $hash
         *
         * @return array
         */
        public function info(string $hash): array
        {
            return password_get_info($hash);
        }

        /**
         * @param string $password
         * @param string $hash
         *
         * @return boolean
         */
        public function verify($password, string $hash): bool
        {
            if (strlen($hash) === 0) {
                return false;
            }

            return password_verify($password, $hash);
        }

        /**
         * @param string $password
         * @param array $options
         *
         * @return string
         */
        abstract function hash($password, array $options = []): string;

        /**
         * @param string $hash
         * @param array $options
         *
         * @return bool
         */
        abstract function needsRehash(string $hash, array $options = []): bool;

        /**
         * @return int
         */
        abstract function algorithm(): int;
    }
}