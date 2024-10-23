<template>
    <div
        class="transit-flex-box safari-legal-height landscape:tw-h-auto tw-flex tw-flex-col tw-h-full tw-w-full tw-max-w-full"
    >
        <h1 class="tw-block legal-header">Widerrufsbelehrung</h1>
        <div
            class="shrink-transit-flex-box safari-legal-height landscape:tw-max-h-full tw-flex tw-flex-col tw-h-auto tw-w-full tw-max-w-full md:tw-overflow-auto"
        >
            <section class="legal-paragraph">
                <h2 class="legal-subheader tw-block">Widerrufsrecht</h2>
                <p>
                    Ein Verbraucher ist jede natürliche Person, die ein Rechtsgeschäft zu
                    Zwecken abschließt, die überwiegend weder ihrer gewerblichen noch
                    ihrer selbständigen beruflichen Tätigkeit zugerechnet werden können.
                    Als Verbraucher haben das Recht, binnen vierzehn Tagen ohne Angabe von
                    Gründen diesen Vertrag zu widerrufen. Die Widerrufsfrist beträgt
                    vierzehn Tage ab dem Tag, an dem Sie oder ein von Ihnen benannter
                    Dritter, der nicht der Beförderer ist, die Waren in Besitz genommen
                    haben bzw. hat. Um Ihr Widerrufsrecht auszuüben, müssen Sie uns
                    mittels einer eindeutigen Erklärung (z.B. ein mit der Post versandter
                    Brief, Telefax oder E-Mail) über Ihren Entschluss, diesen Vertrag zu
                    widerrufen, informieren. Unsere Kontaktdaten finden Sie im
                    <a
                        href="/masthead/legal/impressum"
                        class="tw-underline hover:tw-text-steilgut-gold"
                        >Impressum</a
                    >. Zur Wahrung der Widerrufsfrist reicht es aus, dass Sie die
                    Mitteilung über die Ausübung des Widerrufsrechts vor Ablauf der
                    Widerrufsfrist absenden.
                </p>
            </section>
            <section class="legal-paragraph">
                <h2 class="legal-subheader tw-block">Folgen des Widerrufs</h2>
                <p>
                    Wenn Sie diesen Vertrag widerrufen, haben wir Ihnen alle Zahlungen,
                    die wir von Ihnen erhalten haben, einschließlich der Lieferkosten,
                    unverzüglich und spätestens binnen vierzehn Tagen ab dem Tag
                    zurückzuzahlen, an dem die Mitteilung über Ihren Widerruf dieses
                    Vertrags bei uns eingegangen ist. Für diese Rückzahlung verwenden wir
                    dasselbe Zahlungsmittel, das Sie bei der ursprünglichen Transaktion
                    eingesetzt haben, es sei denn, mit Ihnen wurde ausdrücklich etwas
                    anderes vereinbart; in keinem Fall werden Ihnen wegen dieser
                    Rückzahlung Entgelte berechnet. Wir können die Rückzahlung verweigern,
                    bis wir die Waren wieder zurückerhalten haben oder bis Sie den
                    Nachweis erbracht haben, dass Sie die Waren zurückgesandt haben, je
                    nachdem, welches der frühere Zeitpunkt ist. Sie haben die Waren
                    unverzüglich und in jedem Fall spätestens binnen vierzehn Tagen ab dem
                    Tag, an dem Sie uns über den Widerruf dieses Vertrags unterrichten, an
                    uns zurückzusenden oder zu übergeben. Die Frist ist gewahrt, wenn Sie
                    die Waren vor Ablauf der Frist von vierzehn Tagen absenden. Sie tragen
                    die unmittelbaren Kosten der Rücksendung der Waren. Für einen etwaigen
                    Wertverlust der Waren müssen Sie nur aufkommen, wenn dieser
                    Wertverlust auf einen zur Prüfung der Beschaffenheit, Eigenschaften
                    und Funktionsweise der Waren nicht notwendigen Umgang mit ihnen
                    zurückzuführen ist.
                </p>
            </section>
            <section class="legal-paragraph">
                <h2 class="legal-subheader tw-block">
                    Bestellvorgang und Vertragsabschluss
                </h2>
                <p>
                    Der Kunde kann aus dem Sortiment des Verkäufers Produkte unverbindlich
                    auswählen und diese über die Schaltfläche in den Warenkorb in einem so
                    genannten Warenkorb sammeln. Innerhalb des Warenkorbes kann die
                    Produktauswahl verändert, z.B. gelöscht werden. Anschließend kann der
                    Kunde innerhalb des Warenkorbs über die Schaltfläche Weiter zur Kasse
                    zum Abschluss des Bestellvorgangs schreiten. Über die Schaltfläche
                    zahlungspflichtig bestellen gibt der Kunde einen verbindlichen Antrag
                    zum Kauf der im Warenkorb befindlichen Waren ab. Vor Abschicken der
                    Bestellung kann der Kunde die Daten jederzeit ändern und einsehen
                    sowie mithilfe der Browserfunktion „zurück“ zum Warenkorb zurückgehen
                    oder den Bestellvorgang insgesamt abbrechen. Notwendige Angaben sind
                    mit einem Sternchen (*) gekennzeichnet. Der Verkäufer schickt
                    daraufhin dem Kunden eine Empfangsbestätigung innerhalb von 24 Stunden
                    per E-Mail zu, in welcher die Bestellung des Kunden nochmals
                    aufgeführt wird (Bestellbestätigung). Die automatische
                    Empfangsbestätigung dokumentiert lediglich, dass die Bestellung des
                    Kunden beim Verkäufer eingegangen ist und stellt keine Annahme des
                    Antrags dar. Der Kaufvertrag kommt erst dann zustande, wenn der
                    Verkäufer das bestellte Produkt innerhalb von 5 Tagen an den Kunden
                    versendet, übergeben oder den Versand an den Kunden innerhalb von 5
                    Tagen mit einer zweiten E-Mail, ausdrücklicher Auftragsbestätigung
                    oder Zusendung der Rechnung bestätigt hat.
                </p>
            </section>
            <section class="legal-paragraph">
                <h2 class="legal-subheader tw-block">Muster-Formular</h2>
                <p>
                    Sie können dafür folgendes
                    <a
                        href="/legal/widerruf-muster"
                        class="tw-underline hover:tw-text-steilgut-gold"
                        >Muster-Widerrufsformular</a
                    >
                    verwenden.
                </p>
            </section>
        </div>
    </div>
</template>

<script>
import validationErrors from "../../mixins/validationErrors";
import mediaHelper from "../../mixins/mediaHelper";
import { refreshFullPageContainers } from "../../utils/resizer";
import { mapGetters, mapState } from "vuex";
import { Helper } from "../../utils/helper";
export default {
    mixins: [validationErrors, mediaHelper],

    components: {},

    methods: {},

    computed: {},
};
</script>

<style lang="scss" scoped>
@import "@/sass/legal/legal.scss";
</style>
