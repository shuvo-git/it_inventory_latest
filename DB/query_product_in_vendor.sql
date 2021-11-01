select `stock_details`.`unique_id`, `stock_details`.`id` from `stock_details` 
inner join `repair_product_details` on `repair_product_details`.`product_unique_id` = `stock_details`.`id` 
inner join `send_to_repair` on `send_to_repair`.`id` = `repair_product_details`.`repair_id` 
where `send_to_repair`.`supplier_id` = 1 and stock_details.product_id = 8




/* stock_details */

DELIMITER $$

USE `it_inventory`$$

DROP TRIGGER IF EXISTS `purchase_stock`$$

CREATE
    TRIGGER `purchase_stock` AFTER INSERT ON `stock_details`
    FOR EACH ROW BEGIN
    SET @COUNT=(SELECT COUNT(*) FROM stocks WHERE (item_id=NEW.product_id ));
    IF @COUNT=0 THEN
        INSERT INTO stocks (item_id,purchase_q)VALUES (NEW.product_id,NEW.quantity);
    ELSE
        UPDATE stocks
        SET purchase_q = purchase_q + NEW.quantity
        WHERE item_id = NEW.product_id;
    END IF;
    END;
$$

DELIMITER ;



/* stockout_details */

DELIMITER $$

USE `it_inventory`$$

DROP TRIGGER IF EXISTS `issue_stock`$$

CREATE
    TRIGGER `issue_stock` AFTER INSERT ON `stockout_details`
    FOR EACH ROW BEGIN
    SET @COUNT=(SELECT COUNT(*) FROM stocks WHERE (item_id=NEW.product_id ) );
    IF @COUNT=0 THEN
        INSERT INTO stocks (item_id,purchase_q)VALUES (NEW.product_id,NEW.quantity);
    ELSE
        UPDATE stocks
        SET purchase_q = purchase_q + NEW.quantity
        WHERE item_id = NEW.product_id;
    END IF;
    END;
$$

DELIMITER ;




