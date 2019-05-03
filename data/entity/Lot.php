<?php



/*
create table lot
(
	id bigint auto_increment
		primary key,
	title varchar(255) null,
	image_url text null,
	description text null,
	created_at timestamp null,
	status varchar(255) null,
	started_at timestamp null,
	duration bigint null,
	finished_at timestamp null,
	seller_user_id bigint null,
	buyer_user_id bigint null,
	category varchar(255) null,
	starting_price decimal(19, 2) not null,
	constraint lot_buyer_user_account_id_fk
		foreign key (buyer_user_id) references user_account (id),
	constraint lot_seller_user_account_id_fk
		foreign key (seller_user_id) references user_account (id)
);
*/
class Lot {

    public $id;
    public $title;
    public $imageUrl;
    public $description;
    public $category;
    public $startingPrice;

    public $sellerId;
    public $buyerId;

    public $createdAt;
    public $status;
    public $startedAt;
    public $duration;
    public $finishedAt;
    public $bids;

}