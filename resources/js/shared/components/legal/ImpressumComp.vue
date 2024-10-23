<template>
    <div
        class="transit-flex-box safari-legal-height landscape:tw-h-auto tw-flex tw-flex-col tw-h-full tw-w-full tw-max-w-full"
    >
        <h1 class="tw-block legal-header">Impressum</h1>
        <div
            class="shrink-transit-flex-box safari-legal-height tw-flex tw-flex-col tw-h-auto tw-w-full tw-max-w-full md:tw-overflow-auto"
        >
            <section class="legal-paragraph">
                <h2 class="legal-subheader tw-block">Angaben gemäß § 5 TMG</h2>
                Dieser Webseite repräsentiert die Internetpräsenz von<br />
                Steilgut Weine<br />
                vertreten durch: Philipp Franzen<br />
                Auf Cales 54<br />
                56814 Bremm<br />
            </section>
            <section class="legal-paragraph">
                <h2 class="legal-subheader tw-block">Kontakt</h2>
                Telefon: +49(151)-56959421<br />
                E-Mail: info(at)
                <a
                    href="mailto: steilgut-weine.de"
                    class="hover:tw-text-steilgut-gold tw-underline"
                    >steilgut-weine.de</a
                ><br />
            </section>
            <section class="legal-paragraph">
                <h2 class="tw-font-bold tw-inline tw-w-fit-content">Umsatzsteuer-ID:</h2>
                <span class="tw-inline tw-w-fit-content">
                    nicht zugeteilt (da Kleinunternehmer)</span
                >
            </section>
            <section class="legal-paragraph">
                <h2 class="legal-subheader tw-block">Zuständige Aufsichtsbehörde:</h2>
                Landwirtschaftskammer Rheinland-Pfalz Burgenlandstraße 55543 Bad Kreuznach
                www.lwk-rlp.de
            </section>

            <section class="legal-paragraph">
                <h2 class="legal-subheader tw-block">Zuständiges Ministerium:</h2>
                Ministerium für Umwelt, Landwirtschaft, Ernährung, Weinbau und Forsten
                Kaiser-Friedrich-Straße 1 55116 Mainz
            </section>

            <section class="legal-paragraph">
                <h2 class="legal-subheader tw-block">Streitschlichtung:</h2>
                Die Europäische Kommission stellt unter
                <a href="https://www.ec.europa.eu/consumers/odr"
                    >https://www.ec.europa.eu/consumers/odr</a
                >
                eine Plattform zur Online-Streitbeilegung (OS-Plattform) bereit. Wir sind
                nicht bereit oder verpflichtet, an dem Streitschlichtungsverfahren
                teilzunehmen.
            </section>

            <section class="legal-paragraph">
                <h2 class="legal-subheader tw-block">Haftung für Inhalte</h2>
                Die Inhalte unserer Seiten wurden mit größter Sorgfalt erstellt. Für die
                Richtigkeit, Vollständigkeit und Aktualität der Inhalte können wir jedoch
                keine Gewähr übernehmen. Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG
                für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen
                verantwortlich. Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch
                nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu
                überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige
                Tätigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der
                Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon
                unberührt. Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt
                der Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden
                von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend
                entfernen.
            </section>

            <section class="legal-paragraph">
                <h2 class="legal-subheader tw-block">Haftung für Links</h2>
                Unser Angebot enthält Links zu externen Webseiten Dritter, auf deren
                Inhalte wir keinen Einfluss haben. Deshalb können wir für diese fremden
                Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten
                Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten
                verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung
                auf mögliche Rechtsverstöße überprüft. Rechtswidrige Inhalte waren zum
                Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente inhaltliche
                Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte
                einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von
                Rechtsverletzungen werden wir derartige Links umgehend entfernen.
            </section>

            <section class="legal-paragraph">
                <h2 class="legal-subheader tw-block">Urheberrecht</h2>
                Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen
                Seiten unterliegen dem deutschen Urheberrecht. Die Vervielfältigung,
                Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen
                des Urheberrechtes bedürfen der schriftlichen Zustimmung des jeweiligen
                Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur für den
                privaten, nicht kommerziellen Gebrauch gestattet. Soweit die Inhalte auf
                dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte
                Dritter beachtet. Insbesondere werden Inhalte Dritter als solche
                gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung
                aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei
                Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte umgehend
                entfernen.
            </section>
            <section class="legal-paragraph">
                Impressum erstellt durch
                <a
                    href="impressum-generator.de"
                    class="tw-underline hover:tw-text-steilgut-gold"
                    >impressum-generator.de</a
                >
                von der
                <a
                    href="https://www.kanzlei-hasselbach.de/"
                    class="tw-underline hover:tw-text-steilgut-gold"
                    >Kanzlei Hasselbach</a
                >
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
