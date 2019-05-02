<?php

/*
create table bet
(
	id bigint auto_increment
		primary key,
	created_at timestamp default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP,
	bidder_user_id bigint not null,
	lot_id bigint not null,
	bid_amount int not null,
	constraint bet_lot_id_fk
		foreign key (lot_id) references lot (id),
	constraint bet_user_account_id_fk
		foreign key (bidder_user_id) references user_account (id)
);
*/

class Bet {

    public $id;
    public $createdAt;
    public $bidderId;
    public $lotId;
    public $amount;

}