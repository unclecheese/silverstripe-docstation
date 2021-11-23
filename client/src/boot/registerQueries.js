import Injector from 'lib/Injector';
import query from '../queries/docstationQuery';

export default () => {
  Injector.query.register('DocstationQuery', query);
};

