-- Fonction de recherche de trajets, avec correspondances

CREATE OR REPLACE FUNCTION tripSearch(a_vdep VARCHAR(25), a_varr VARCHAR(25), nb_pass INTEGER, v_ban VARCHAR(25)[] = NULL, c_time INTEGER = 0) RETURNS TABLE(f_vdep VARCHAR(25), f_varr VARCHAR(25), f_vid INTEGER) AS $$
DECLARE
    trip RECORD;
    query_count INTEGER;
BEGIN
    IF (a_vdep <> a_varr) THEN
        v_ban := array_append(v_ban, a_vdep);
        FOR trip IN 
            SELECT t.depart AS r_vdep, t.arrivee AS r_varr, v.id AS r_vid, v.heureDepart AS r_heure, t.distance AS r_dist
            FROM jabaianb.voyage v 
            LEFT JOIN jabaianb.trajet t ON v.trajet = t.id 
            WHERE t.depart = a_vdep
            AND v.nbplace >= nb_pass
            AND NOT (t.arrivee = ANY(v_ban))
            AND (c_time + t.distance) <= 1440
        LOOP
            f_vdep := trip.r_vdep;
            f_varr := trip.r_varr;
            f_vid := trip.r_vid;
            IF (trip.r_varr = a_varr) THEN
                RETURN NEXT;
            ELSE
                SELECT count(*) INTO query_count FROM tripSearch(trip.r_varr, a_varr, nb_pass, v_ban, c_time +  trip.r_dist);
                IF query_count != 0 THEN
                    RETURN NEXT;
                    RETURN QUERY SELECT * FROM tripSearch(trip.r_varr, a_varr, nb_pass, v_ban, c_time + trip.r_dist);
                END IF;
            END IF;
        END LOOP;
    END IF;
END
$$ LANGUAGE plpgsql;


-- Exemple d'utilisation de la fonction
SELECT tripSearch('Paris', 'Lyon', 1);


-- Ancienne version, à ignorer (je la garde car ça peut être utile)
-- CREATE OR REPLACE FUNCTION tripSearch(a_vdep VARCHAR(25), a_varr VARCHAR(25), nb_pass INTEGER, v_ban VARCHAR(25)[] = NULL, c_time INTEGER = 0, l_hour INTEGER = 0) RETURNS TABLE(f_vdep VARCHAR(25), f_varr VARCHAR(25), f_vid INTEGER) AS $$
-- DECLARE
--     trip RECORD;
--     query_count INTEGER;
--     time_interval INTEGER;
-- BEGIN
--     IF (a_vdep <> a_varr) THEN
--         v_ban := array_append(v_ban, a_vdep);
--         FOR trip IN 
--             SELECT t.depart AS r_vdep, t.arrivee AS r_varr, v.id AS r_vid, v.heureDepart AS r_heure, t.distance AS r_dist
--             FROM jabaianb.voyage v 
--             LEFT JOIN jabaianb.trajet t ON v.trajet = t.id 
--             WHERE t.depart = a_vdep
--             AND v.nbplace >= nb_pass
--             AND NOT (t.arrivee = ANY(v_ban))
--             AND (
--                     CASE WHEN (v.heureDepart < l_hour) THEN
--                         c_time + ((24 - v.heureDepart + l_hour) * 60) + t.distance
--                     ELSE
--                         c_time + ((v.heureDepart - l_hour) * 60) + t.distance
--                     END <= 1440
--                 OR 
--                     c_time = 0
--             )
--         LOOP
--             f_vdep := trip.r_vdep;
--             f_varr := trip.r_varr;
--             f_vid := trip.r_vid;
--             IF c_time = 0 THEN
--                 l_hour := trip.r_heure;
--             END IF;
--             IF (trip.r_heure < l_hour) THEN
--                 time_interval := c_time + ((24 - trip.r_heure + l_hour) * 60) + trip.r_dist;
--             ELSE
--                 time_interval := c_time + ((trip.r_heure - l_hour) * 60) + trip.r_dist;
--             END IF;
--             IF (trip.r_varr = a_varr) THEN
--                 RETURN NEXT;
--             ELSE
--                 SELECT count(*) INTO query_count FROM tripSearch(trip.r_varr, a_varr, nb_pass, v_ban, c_time + time_interval +  trip.r_dist);
--                 IF query_count != 0 THEN
--                     RETURN NEXT;
--                     RETURN QUERY SELECT * FROM tripSearch(trip.r_varr, a_varr, nb_pass, v_ban, c_time + time_interval + trip.r_dist);
--                 END IF;
--             END IF;
--         END LOOP;
--     END IF;
-- END
-- $$ LANGUAGE plpgsql;

-- tripSearch(a_vdep VARCHAR(25), a_varr VARCHAR(25), nb_pass INTEGER, v_ban VARCHAR(25)[], c_time INTEGER, l_hour INTEGER)