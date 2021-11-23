import React from 'react';
import { withApollo, Query } from 'react-apollo';
import gql from 'graphql-tag';
import { compose } from 'redux';
import { inject } from 'lib/Injector';
import DocstationInterface from './DocstationInterface';

const QUERY = gql`
query DocstationQuery($dir: String!) {
  readDocstationDocs(dir: $dir) {
    id
    title
    content
    sort
  }
}
`;

const Docstation = ({ Loader }) => (
  <Query query={QUERY} variables={{ dir: 'app/docs' }}>
    {({ data, loading, error }) => {
      if (loading) {
        return <Loader />;
      }
      if (error) {
        return (
          <div>
            <h2>Error</h2>
            <pre>{JSON.stringify(error)}</pre>
          </div>
        );
      }
      const docs = data && data.readDocstationDocs ? data.readDocstationDocs : [];
      docs.sort((a, b) => (
        a.sort > b.sort ? 1 : -1
      ));
      return (
        <DocstationInterface docs={docs} />
      );
    }}
  </Query>
);


export default compose(
  inject(
    ['Loading'],
    (Loading) => ({
      Loader: Loading
    }),
    () => 'Docstation',
  ),
  withApollo
)(Docstation);
