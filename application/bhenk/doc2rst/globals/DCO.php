<?php

namespace bhenk\doc2rst\globals;

enum DCO: string {

    case api = "@api";
    case author = "@author";
    case copyright = "@copyright";
    case deprecated = "@deprecated";
    case description = "description";
    case generated = "@generated";
    case inheritDoc = "@inheritDoc";
    case internal = "@internal";
    case license = "@license";
    case link = "@link";
    case method = "@method";
    case package = "@package";
    case param = "@param";
    case return = "@return";
    case see = "@see";
    case signature = "signature";
    case since = "@since";
    case summary = "summary";
    case todo = "@todo";
    case throws = "@throws";
    case uses = "@uses";
    case version = "@version";
}
