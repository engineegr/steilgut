<template>
    <div
        class="transit-flex-box safari-legal-height landscape:tw-h-auto tw-flex tw-flex-col tw-h-full tw-w-full tw-max-w-full"
    >
        <h1 class="tw-block legal-header">Versand & Lieferung</h1>
        <div
            class="shrink-transit-flex-box safari-legal-height landscape:tw-max-h-full tw-flex tw-flex-col tw-h-auto tw-w-full tw-max-w-full md:tw-overflow-auto"
        >
            <section class="legal-paragraph">
                <h2 class="legal-subheader tw-block">
                    Preise, Versandkosten und Lieferinformationen
                </h2>
                <p>
                    Die auf den Produktseiten genannten Preise enthalten alle relevanten
                    Preisbestandteile mit Ausnahme des Versands. Wir liefern unsere Weine
                    weltweit. Der Versand der Ware erfolgt innerhalb weniger Tage. Bei
                    Neukunden und bei Bestellungen aus dem Ausland bitten wir um
                    Verständnis, dass der Versand der Ware erst nach Zahlungseingang
                    erfolgt.Die Versandkosten werden Ihnen auf der Bestellseite und auf
                    der Übersichtsseite nochmals deutlich mitgeteilt.
                </p>
            </section>
            <section class="legal-paragraph">
                <h2 class="legal-subheader tw-block">
                    Versandkostenpauschale. Lieferung innerhalb Deutschlands
                </h2>
                <p>
                    Zusätzlich zu den angegebenen Preisen berechnen wir für die Lieferung
                    innerhalb Deutschlands pauschal 8 Euro pro Bestellung. Ab 12 Flaschen
                    entfallen die Versandkosten.
                </p>
            </section>
            <section class="legal-paragraph">
                <h2 class="legal-subheader tw-block">Lieferung innerhalb EU</h2>
                <p>
                    Zusätzlich zu den angegebenen Preisen berechnen wir für die Lieferung
                    innerhalb der EU pauschal 18,00 Euro pro Bestellung.
                </p>
            </section>
            <section class="legal-paragraph">
                <h2 class="legal-subheader tw-block">Lieferung weltweit</h2>
                <p>
                    Zusätzlich zu den angegebenen Preisen berechnen wir für die Lieferung
                    pauschal 45,00 Euro pro Bestellung.
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
