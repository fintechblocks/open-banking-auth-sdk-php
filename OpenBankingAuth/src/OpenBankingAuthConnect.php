<?php
    class OpenBankingAuthConnect {
        private $config;
        public function __construct(array $config) {
            $this->config = array_merge([
                "url" => "",
                "header" => "",
                "post" => ""
            ], $config);
        }

        public function getResponse() {
            $ch = curl_init($this->config["url"]);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //Dangerous, do not use in production!
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->config["header"]);
            if (isset($this->config["post"]) && $this->config["post"] != "") {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $this->config["post"]);
            }
            $responseFromServer = curl_exec($ch);
            curl_close($ch);
            return $responseFromServer;
        }
    }
?>