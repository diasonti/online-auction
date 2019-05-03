<?php

/*
create table bid
(
	id bigint auto_increment
		primary key,
	created_at timestamp default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP,
	bidder_user_id bigint not null,
	lot_id bigint not null,
	bid_amount decimal(19, 2) not null,
	constraint bet_lot_id_fk
		foreign key (lot_id) references lot (id),
	constraint bet_user_account_id_fk
		foreign key (bidder_user_id) references user_account (id)
);
*/

class Bid {

    public $id;
    public $createdAt;
    public $bidderId;
    public $lotId;
    public $amount;

}