import { Button } from './button.js';
import { Switch } from './switch.js';
import { Input } from './input.js';
import { Select, Option } from './select.js';
import { Image } from './image.js';
import { SimpleAccordion, MultiAccordion, AccordionItem } from "./accordion.js";
import { TabsContainer, TabItem, TabContent, TabItems } from './tabs.js';

[
    Button, Switch, Input, Select, Option,
    Image,
    SimpleAccordion, MultiAccordion, AccordionItem,
    TabsContainer, TabItem, TabContent, TabItems
].map(component => component.create());
