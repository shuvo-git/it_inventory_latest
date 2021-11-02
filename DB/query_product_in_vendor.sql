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
     
        UPDATE stocks
        SET issue_q = issue_q + 1
        WHERE item_id = NEW.product_id;
     
    END;
$$

DELIMITER ;

/* branch_return_details */

DELIMITER $$

USE `it_inventory`$$

DROP TRIGGER IF EXISTS `br_ret_stock`$$

CREATE
    TRIGGER `br_ret_stock` AFTER INSERT ON `branch_return_details`
    FOR EACH ROW BEGIN
     
        UPDATE stocks
        SET br_ret_q = br_ret_q + 1
        WHERE item_id = NEW.product_id;
     
    END;
$$

DELIMITER ;

/* repair_product_details */

DELIMITER $$

USE `it_inventory`$$

DROP TRIGGER IF EXISTS `in_vendor_stock`$$

CREATE
    TRIGGER `in_vendor_stock` AFTER INSERT ON `repair_product_details`
    FOR EACH ROW BEGIN
     
        UPDATE stocks
        SET ven_q = ven_q + 1
        WHERE item_id = NEW.product_id;
     
    END;
$$

DELIMITER ;


/* return_from_vendor_details */

DELIMITER $$

USE `it_inventory`$$

DROP TRIGGER IF EXISTS `vendor_ret_stock`$$

CREATE
    TRIGGER `vendor_ret_stock` AFTER INSERT ON `return_from_vendor_details`
    FOR EACH ROW BEGIN
     
        UPDATE stocks
        SET ven_ret_q = ven_ret_q + 1
        WHERE item_id = NEW.product_id;
     
    END;
$$

DELIMITER ;



