<template>
    <div
        class="transit-flex-box safari-legal-height landscape:tw-h-auto tw-flex tw-flex-col tw-h-full tw-w-full tw-max-w-full"
    >
        <h1 class="tw-block legal-header">Zahlungsarten</h1>
        <div
            class="shrink-transit-flex-box safari-legal-height landscape:tw-max-h-full tw-flex tw-flex-col tw-h-auto tw-w-full tw-max-w-full md:tw-overflow-auto"
        >
            <section class="legal-paragraph">
                <p>
                    Wir bieten Ihnen folgende Zahlungsarten an. Suchen Sie sich einfach
                    die für Sie optimale Zahlart aus. Die in den jeweiligen Angeboten
                    angeführten Preise stellen Endpreise dar. Sie beinhalten alle
                    Preisbestandteile, mit Ausnahme der Versandkosten, die separat
                    ausgewiesen werden. Gemäß § 19 UStG enthält der Rechnungsbetrag keine
                    Umsatzsteuer. Nur bei grenzüberschreitender Lieferung können im
                    Einzelfall weitere Steuern (z.B. im Falle eines
                    innergemeinschaftlichen Erwerbs) und/oder Abgaben (z.B. Zölle) von
                    Ihnen zu zahlen sein, jedoch nicht an den Verkäufer, sondern an die
                    dort zuständigen Zoll- bzw. Steuerbehörden.
                </p>
            </section>
            <section class="legal-paragraph">
                <h2 class="legal-subheader tw-block">Auf Rechnung</h2>
                <p>
                    Wir schicken Ihnen eine Rechnung via E-Mail oder Post zu und Sie
                    zahlen per Bankverbindung. Bitte haben Sie Verständnis dafür, dass wir
                    bei Neukunden ggf. den Rechnungsbetrag per Vorkasse verlangen.
                </p>
            </section>
            <section class="legal-paragraph">
                <h2 class="legal-subheader tw-block">Kreditkarte</h2>
                <p>
                    Auf unserer Website bieten wir u.a. die Bezahlung via Kreditkarte an.
                    Anbieter dieses Zahlungsdienstes ist Stripe Payments Europe, Limited
                    („Stripe“) mit der Adresse C/O A&L Goodbody, Ifsc, North Wall Quay
                    Dublin 1., Dublin. Die hierzu erforderlichen Kreditkartendaten werden
                    verschlüsselt an den Zahlungsanbieter weitergeleitet und sind für den
                    Webseitenbetreiber nicht einsehbar (auch wenn die Eingabe direkt auf
                    der Webseite erfolgt). Eine Weiterverarbeitung und Speicherung der
                    Daten seitens Stripe zur Gewährleistung der Zahlungsabwicklung erfolgt
                    gegebenenfalls außerhalb der EU. Für diese Schritte ist ausschließlich
                    Stripe verantwortlich. Weitere Details zur Zahlung mit Stripe
                    entnehmen Sie den Datenschutzbestimmungen
                    <a
                        href="https://stripe.com/de/privacy"
                        class="tw-underline hover:tw-text-steilgut-gold"
                        >https://stripe.com/de/privacy</a
                    >.
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
