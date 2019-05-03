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
	constraint bid_lot_id_fk
		foreign key (lot_id) references lot (id),
	constraint bid_user_account_id_fk
		foreign key (bidder_user_id) references user_account (id)
);
create trigger validate_bid_amount before insert on bid
for each row
begin
if new.bid_amount <= (COALESCE((SELECT max(b.bid_amount) FROM bid b WHERE b.lot_id = new.lot_id), 0.99)) then
signal sqlstate '45000';
end if;
end;
*/

class Bid {

    public $id;
    public $createdAt;
    public $bidderId;
    public $lotId;
    public $amount;

}