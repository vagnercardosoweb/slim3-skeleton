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
     * Class Bcrypt
     *
     * @package Core\Password
     * @author Vagner Cardoso <vagnercardosoweb@gmail.com>
     */
    class Bcrypt extends Password
    {
        /**
         * @param string $password
         * @param array $options
         *
         * @return string
         */
        public function hash($password, array $options = []): string
        {
            $hash = password_hash($password, $this->algorithm(), [
                'cost' => $options['cost'] ?? PASSWORD_BCRYPT_DEFAULT_COST,
            ]);

            if ($hash === false) {
                throw new \RuntimeException(
                    "Bcrypt password not supported."
                );
            }

            return $hash;
        }

        /**
         * @param string $hash
         * @param array $options
         *
         * @return bool
         */
        public function needsRehash(string $hash, array $options = []): bool
        {
            return password_needs_rehash($hash, $this->algorithm(), [
                'cost' => $options['cost'] ?? PASSWORD_BCRYPT_DEFAULT_COST,
            ]);
        }

        /**
         * @return int
         */
        public function algorithm(): int
        {
            return PASSWORD_BCRYPT;
        }
    }
}